<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="hero-wrap hero-bread" style="background-image: url(<?php echo URLROOT; ?>/images/post-item7.jpg)">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span></p>
                <h1 class="mb-0 bread">Contact Us</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="w-100"></div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                <p><span>Address:</span> Amman - Al Madinah Street - Building No. 10</p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                <p><span>Phone:</span> <a href="tel://0771234567">+962 77 123 4567</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">s_shop01@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Website</span> <a href="#">smartshop.com</a></p>
                </div>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form action="<?php echo URLROOT; ?>/pages/contact" class="bg-white p-5 contact-form" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="full_name" placeholder="Your Name" value="<?php echo $data['full_name'] ?? ''; ?>">
                        <span class="text-danger"><?php echo $data['full_name_err'] ?? ''; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" value="<?php echo $data['email'] ?? ''; ?>">
                        <span class="text-danger"><?php echo $data['email_err'] ?? ''; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" value="<?php echo $data['subject'] ?? ''; ?>">
                        <span class="text-danger"><?php echo $data['subject_err'] ?? ''; ?></span>
                    </div>
                    <div class="form-group">
                        <textarea cols="30" rows="7" class="form-control" name="message" placeholder="Message" maxlength="500"><?php echo $data['message'] ?? ''; ?></textarea>
                        <span class="text-danger"><?php echo $data['message_err'] ?? ''; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex">
                <div class="bg-white p-3">
                    <img src="https://cdn.shulex-voc.com/shulex/upload/2024-06-28/1eb69cab-1135-4e1b-9e02-38204c7aeec9.jpg" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-gallery">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 heading-section text-center mb-4 ftco-animate">
                <h2 class="mb-4">Follow Us On Instagram</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <!-- Gallery Items Here -->
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
