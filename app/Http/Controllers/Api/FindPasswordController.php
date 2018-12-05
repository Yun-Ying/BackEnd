<?php

    namespace App\Http\Controllers\Api;

    use App\User;
    use function foo\func;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\SendMailable;

    class FindPasswordController extends Controller
    {
        public function find(Request $request){

            $inputname = $request->input('name');
            $inputemail = $request->input('email');

            $user = User::where('email', $inputemail)->get();

            //user found
            if(count($user) != 0)
            {
                $verifycode = rand(100000,999999);
                $msg = "Dear " . $inputname ."\n" . "Your VerifyCode is : \n\n" . $verifycode;

                // mail($inputemail,'VerifyCode', $msg, "From: noreply@gmail.com");


                Mail::raw($msg, function($message) use ($user){

                    $message->from('any@gmail.com', 'NarutOuO');

                    $message->to($user[0]->email , 'To '. $user[0]->name)->subject('Verifying Code');
                });

                return response()->json($verifycode);
            }
            else{
            }
//        if(mail('','test','來自全端'))
//            return response()->json($temp);
//        ;
        }

        public function mail(Request $request){
            $nickname = $request->input('nickname');
            $title = $request->input('title');
            $email = $request->input('email');
            $text = $request->input('text');
            $temp = [
                "nickname" =>$nickname,
                "title" => $title,
                "email" => $email,
                "text" => $text,
            ];
            $msg = "NickName : " . $nickname . "\n" . "Title : " . $title . "\n" . "Email : " . $email . "\n" . "Text : " . $text . "\n";
            Mail::raw($msg, function($message) use($email){

                $message->from('any@gmail.com', 'NarutOuO');

                $message->to('narutouo1111@gmail.com' , 'To '. 'narutouo1111@gmail.com') ->subject("Contact Us, from " . $email);
            });
            return response()->json($temp);
        }

        public function reset(Request $request){

            $email = $request->input('email');
            $password = $request->input('password');

            $user = User::where('email', $email)->get();


            if(count($user)!=0){
                $user[0]->password = Hash::make($password);

                $user[0]->save();
            }

            return 'done reset!';

        }

        public function testreset($id, $password){
            $user = User::find($id);

            if(count($user)!=0){
                $user->password = Hash::make($password);

                $user->save();
            }

        }

        public function testFind($id)
        {
            $user = User::find($id);

            $verifycode = rand(100000,999999);
            $msg = "Dear " . $user->name ."\n" . "Your VerifyCode is : \n\n" . $verifycode;

            Mail::raw($msg, function($message) use ($user){

                $message->from('fany@gmail.com', 'noreply');

                $message->to('narutouo1111@gmail.com' , 'To '. $user->name)->subject('Verifying Code');
            });

//            $verifycode = rand(100000,999999);
//            $msg = "Dear " . 'ngkaizhe' ."\n" . "Your VerifyCode is : \n\n" . $verifycode;
//
//            mail('kaizhe1991@hotmail.com' ,'VerifyCode', $msg, "From: noreply@gmail.com");

            return 'Email was sent';
        }


    }
