<!--contact section start-->
<div class="contact-section">
  <div class="contact-info">
    <div><i class="fas fa-map-marker-alt"></i>Address, City, Country</div>
    <div><i class="fas fa-envelope"></i>harsh5339@email.com</div>
    <div><i class="fas fa-phone"></i>+91 8989821760</div>
    <div><i class="fas fa-clock"></i>Mon-Fri 8:00am to 5:00pm</div>
  </div>

  <div class="contact-form">
    <span class="heading">Contact Us</span>
    <form method="post">
      <label for="name">Name:</label>
      <center> <input type="text" name="username" placeholder="Username" required="" maxlength="20"></center>
      <label for="email">E-mail:</label>
      <center> <input type="email" id="email" name="email" maxlength="30" placeholder="abc123@gmail.com" required=""></center>
      <label for="message">Message:</label>
      <center> <textarea rows="7" class="textpp" id="message" name="message" maxlength="100" placeholder="Type here..." required></textarea></center>
      <center> <button type="submit" name="submit">Submit</button></center>
    </form>
  </div>
</div>
<!--contact section end-->
<?php
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn,$_POST['username']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $msg = mysqli_real_escape_string($conn,$_POST['message']);

  $qry = "INSERT INTO contact(username,email,message) VALUES ('" . $name . "','" . $email . "','" . $msg . "')";

  $res1 = mysqli_query($conn, $qry);

  if ($res1) {
?>
    <script>
      alert('Your Message has been successfully sent.');
    </script>
  <?php
  } else {
  ?>
    <script>
      alert('Error 404');
    </script>
<?php
  }
}
?>