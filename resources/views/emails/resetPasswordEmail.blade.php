<!DOCTYPE html>
<html>
<head>
    <title>Επαναφωρά Κωδικού</title>
</head>
    <body>
        <h1>Καλώς ήρθατε ξανά στην εφαρμογή μας!</h1>
        <p>Για να επαληθεύσετε το email σας πατήστε στον σύνδεσμο:</p>
        <p><a href="{{ 'https://antallakseto.gr/passwordSet?token='.$user->reset_password_token }}">Επαναφωρά Κωδικού</a></p>
        <p>Ή εδώ: <a href="{{ 'https://antallakseto.gr/passwordSet?token='.$user->reset_password_token }}">{{ env('FRONT_END_URL').'/passwordSet?token='.$user->reset_password_token }}</a></p>
        <p>Ευχόμαστε να απολαύσετε την εμπειρία σας με την εφαρμογή μας. Εάν έχετε οποιεσδήποτε ερωτήσεις ή ανάγκη από βοήθεια, παρακαλούμε επικοινωνήστε μαζί μας στο antallaxeto.gr@gmail.com.</p>
    </body>
</html>
