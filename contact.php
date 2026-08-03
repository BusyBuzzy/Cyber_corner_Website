<?php require "template/header.php"; ?>

<!-- Breadcrumb Start -->
<div class="container-fluid mt-3">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <span class="breadcrumb-item active">Contact</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form action="https://api.web3forms.com/submit" method="POST">
                    <input type="hidden" name="access_key" value="7f69b4a3-3fc8-4334-a8db-b937acccea11">
                  
                    
                    <div class="form-floating mb-3">
                    <label for="floatingInput">Name</label>
                        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Name" required="required" data-validation-required-message="Please enter your name">
                      
                    </div>
                    <div class="form-floating">
                    <label for="floatingPassword">Email</label>
                        <input type="email" name="email" class="form-control" id="floatingPassword" placeholder="Email" required="required" data-validation-required-message="Please enter your email">
                      
                    </div>
                    <div class="form-floating">
                    <label for="floatingTextarea">Message</label>
                        <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea" required="required" data-validation-required-message="Please enter your Message"></textarea>
                       
                    </div>
                  <hr>
                    <button type="submit" class="btn btn-primary mb-3">Send Mail</button>
                  
                    
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.819091582184!2d101.71423827472373!3d3.1424126531945458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc362fe7b7773f%3A0x385decd08d53c9b4!2sThe%20Exchange%20TRX!5e0!3m2!1sen!2smy!4v1720943999755!5m2!1sen!2smy" width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>19 Street, Yangon, Myanmar</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>cybercorner@market.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php require "template/footer.php"; ?>