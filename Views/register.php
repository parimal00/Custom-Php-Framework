<h1>Register page</h1> <br>

<?php $form= app\Core\Form::begin('/register', 'POST'); ?>
<?php echo $form->field($user,'firstname') ?>
<br>
<?php echo $user->hasError('firstname') ? '<span style="color:red">' . $user->getFirstError('firstname') : '' . '</span>' ?>
<input type="text" placeholder="lastname" name="lastname"><br>
<?php echo $user->hasError('lastname') ? '<span style="color:red">' . $user->getFirstError('lastname') : '' . '</span>' ?>
<input type="text" placeholder="email" name="email"><br>
<?php echo $user->hasError('email') ? '<span style="color:red">' . $user->getFirstError('email') : '' . '</span>' ?>
<input type="text" placeholder="password" name="password"> <br>
<?php echo $user->hasError('password') ? '<span style="color:red">' . $user->getFirstError('password') : '' . '</span>' ?>
<input type="text" placeholder="confirm password" name="passwordConfirmation"><br>
<?php echo $user->hasError('passwordConfirmation') ? '<span style="color:red">' . $user->getFirstError('passwordConfirmation') : '' . '</span>' ?>
<button>Register</button>
</form>