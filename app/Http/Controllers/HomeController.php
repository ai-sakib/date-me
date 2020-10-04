<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\User;
use App\Models\UserProfile;
use App\Models\Like;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userList()
    {
        $user = UserProfile::where('user_id', Auth::id())->first();
        $users = DB::table('user_profiles')
            ->select('*', DB::raw(sprintf(
                '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(latitude)))) AS distance',
                $user->latitude,
                $user->longitude
            )))
            ->where('user_id', '!=', $user->id)
            ->having('distance', '<', 5)
            ->orderBy('distance', 'asc')
            ->paginate(10);
        return view('main.user-list', compact('users'));
    }

    public function likeStatus($data)
    {
        $to_user = explode('&', $data)[0];
        $status = explode('&', $data)[1];

        $match = 0;
        $date_partner = '';
        if($status == 0){
            Like::where('from_user', Auth::id())->where('to_user',$to_user)->delete();
        }else{
            Like::insert([
                'from_user' => Auth::id(),
                'to_user' => $to_user,
            ]);

            $matched_like = Like::where('from_user', $to_user)->where('to_user',Auth::id())->first();
            if(isset($matched_like->id)){
                $match = 1;
                $date_partner = User::find($to_user)->name;
            }
        }
        
        return response()->json([
            'success' => true,
            'match' => $match,
            'date_partner' => $date_partner,
        ]);
    }

    public function userProfile()
    {
        $user = User::with('profile')->find(Auth::id());
        return view('main.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {  
        $user = User::find(Auth::id());

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
        ]);


        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        $user_profile = UserProfile::where('user_id', $user->id)->first();
        $user_profile->date_of_birth = $request['date_of_birth'];
        $user_profile->gender = $request['gender'];
        $user_profile->save();

        if($user_profile){ 
            if(isset($user_profile)){
                $file=$request->file('profile_photo');
                if(isset($file)){

                    $request->validate([
                        'profile_photo' => ['mimes:jpeg,jpg,png,gif|max:2048'],
                    ]);
                    if($user_profile->photo != "" && file_exists(public_path('photos/').$user_profile->photo)){
                        unlink(public_path('photos/').$user_profile->photo);
                    }
                    $fileInfo=fileInfo($file);
                    $image='profile-'.date('YmdHis').'.'.$fileInfo['extension']; 
                    $upload=fileUpload($file,'photos',$image);
                    UserProfile::where('id',$user_profile->id)->update(['photo'=>$image]);
                }
            }
            session()->flash('success', 'Profile Updated !');
            return redirect()->back();
        }else{
            session()->flash('error', 'Something Went Wrong !');
            return redirect()->back();
        }
    }

    public function changePassword()
    {  
        return view('main.change-password');
        
    }

    public function updatePassword(Request $request)
    {  
        $validatedData = $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::find(Auth::id());
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request['password']);
            $user->save();
            session()->flash('success', 'Password Changed !');
        }else{
            session()->flash('error', 'old_password');
        }
        return redirect()->back();
        
        
    }

    public function updateLocation($data)
    {   
        $latitude = explode('&', $data)[0];
        $longitude = explode('&', $data)[1];

        if($latitude > 0 && $longitude > 0){
            UserProfile::where('user_id', Auth::id())->first()->update([
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
            session()->flash('success', 'Location Updated !');
        }else{
            session()->flash('error', 'location_not_found');
        }
        return response()->json(['success'=>true]);
    }
}
