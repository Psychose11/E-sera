<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/login.css">
    <title>Ajouter un utilisateur</title>
</head>

<body>
    
<div class="left">

<img src="../images/ressources/robot.gif" alt="" width="90px">




</div>





    <div class="center">
        <h1 style="color:#507294;font-family:cursive;">Create your account😉</h1>

        <form method="post" action="../controller/create_user_controller.php" enctype="multipart/form-data">
    <div class="txt_field">
        <input type="text" name="pseudo" id="pseudo" required>
        <span></span>
        <label>Username</label>
    </div>

    <div class="txt_field">
        <input type="password" name="motdepasse" id="motdepasse" required>
        <span></span>
        <label for="motdepasse">Password</label>
    </div>

    <div class="txt_field">
        <input type="password" name="confirmer_motdepasse" id="confirmer_motdepasse" required>
        <span></span>
        <label for="confirmer_motdepasse">Confirm your password</label>
    </div>

    <div id="passwordMatchNotification" style="display: none; color: red;">Password does not match</div>

    <div class="txt_field">
    <input type="text" name="tel" id="tel" required>
    <span></span>
    <label for="tel">Phone number</label>
   </div>

<script>
    const telField = document.getElementById('tel');

    telField.addEventListener('input', function() {
        let phoneNumber = telField.value.replace(/\D/g, '');
        const phoneNumberPattern = /^0(\d{0,2})(\d{0,2})(\d{0,3})(\d{0,2})$/;

        phoneNumber = phoneNumber.match(phoneNumberPattern);
        if (phoneNumber) {
            let formattedPhoneNumber = '0';
            if (phoneNumber[1]) {
                formattedPhoneNumber += phoneNumber[1];
                if (phoneNumber[1].length === 2) {
                    formattedPhoneNumber += ' ';
                }
            }
            if (phoneNumber[2]) {
                formattedPhoneNumber += phoneNumber[2];
                if (phoneNumber[2].length === 2) {
                    formattedPhoneNumber += ' ';
                }
            }
            if (phoneNumber[3]) {
                formattedPhoneNumber += phoneNumber[3];
                if (phoneNumber[3].length === 3) {
                    formattedPhoneNumber += ' ';
                }
            }
            if (phoneNumber[4]) {
                formattedPhoneNumber += phoneNumber[4];
            }
            telField.value = formattedPhoneNumber.trim();
        } else {
            if (telField.value.length > 1) {
                telField.value = telField.value.slice(0, -1);
            } else {
                telField.value = '';
            }
        }
    });
</script>




    <div class="txt_field">
        <input type="file" name="pdp" id="pdp" style="margin-top:10px;">
        <span></span>
        <label for="pdp">Profile <picture></picture></label>
    </div>
    <input type="submit" value="Sign up">
</form>

<script>
    // Récupérer les références des champs de mot de passe
    const passwordField = document.getElementById('motdepasse');
    const confirmPasswordField = document.getElementById('confirmer_motdepasse');
    const passwordMatchNotification = document.getElementById('passwordMatchNotification');

    // Ajouter un événement de saisie pour vérifier les mots de passe
    confirmPasswordField.addEventListener('input', function() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        if (password !== confirmPassword) {
            passwordMatchNotification.style.display = 'block';
        } else {
            passwordMatchNotification.style.display = 'none';
        }
    });
</script>

    </div>


</body>

</html>