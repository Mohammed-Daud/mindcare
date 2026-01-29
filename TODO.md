
{{ config('app.url') }}
- [+] Fix mail verification
- [+] Handle Case: my email verification link mail is missing. mail deleted
- [+] on http://localhost:8000/login page, after switchiubg I am a... i am getting CSRF token mismatch and if i am selecting doctor role even if i am entering patient credentials then i am getting verify email while it should check role
- [] For professionals, check if approved: perform through middleware
- [] Config return redirect('/home');
- [] client/register redirect to verify email page
- [] register karte hi login ho jayega email verify page dikhane ke liye to maan liya verify nahi kiya fir se register pe aya yo already register dikhao and login pe redirect kar do
        kyuki already register hai to wo home pe redirect hota hai home pe verufy wala middleware lagana padega
        maan lo logout ho gaya?
            to is case me already register dikhata hai. login karne pe verify pe redirect karta hai. verify pe back to login hai uspe click karne se home pe ja raha hai
- [] register karte hi login ho jayega email verify page dikhane ke liye to maan liya verify nahi kiya fir se login pe aya to verify email page dikhao
- [] password/reset
