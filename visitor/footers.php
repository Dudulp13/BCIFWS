<style>
.footer {
    position: absolute;
}

.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    margin-right: 10px;
    font-size: 18px;
}

#reach {
    color: #002D62;
    font-weight: 200;
}

#copy {
    color: #fff;
    font-weight: 200;
}

.icon-circle i {
    margin: 0;
}

.glass-effect {
    background-color: rgba(255, 255, 255, 0.5);
    /*semi-transparent background */
    backdrop-filter: blur(10px);
    /* Blur effect  */
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    /*  shadow */
}
</style>
<footer class="bg-dark "
    style="background-image: url('../img/tithe.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="bg-transparent bg-opacity-33 p-4 rounded">
        <div class="glass-effect row">
            <!-- 1st Column for Contact Info -->
            <div class="col-lg-2 col-md-12 mb-4" id="reach">
                <h4>Reach Us</h4>
                <p>
                    <span class="icon-circle">
                        <i class="fas fa-envelope"></i>
                    </span>
                    bcifsb@gmail.com
                </p>
                <p>
                    <span class="icon-circle">
                        <i class="fas fa-mobile-alt"></i>
                    </span>
                    09096986272
                </p>
                <p>
                    <span class="icon-circle">
                        <i class="fas fa-phone-alt"></i>
                    </span>
                    523-4001
                </p>
                <p>
                    <span class="icon-circle">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    Taft Street, Santa Barbara
                <p class="ps-5 ms-2">Iloilo 5002, Philippines
                </p>
            </div>
            <!-- 2nd Column for map -->
            <div class="col-lg-4 col-md-12 mb-4" id="reach">
                <h4>Our Location</h4>
                <p>
                    <span class="icon-circle">
                        <i class="fas fa-flag"></i>
                    </span>
                    In between Little Baguio and 3E Refrigeration
                </p>
                <p><iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d316.0450813281228!2d122.53671495021617!3d10.824208102812587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aefd3482b760e1%3A0x8ed2abbb02dd2ca1!2sBETHLEHEM!5e1!3m2!1sen!2sph!4v1726975663715!5m2!1sen!2sph"
                        width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe></p>
            </div>


            <!-- 3rd Column for Donation Info -->
            <div class="col-lg-6 col-md-12">
                <div>
                    <h2 class="mb-3">Help Us Advance the Kingdom of God</h2>
                </div>
                <p class="lead text-dark">
                    Your generosity has the power to transform lives within our community and beyond. By contributing to
                    our mission, you are helping to spread love, hope, and essential resources to those in need.
                    Together, we can make a lasting impact and share God’s love with everyone.
                </p>

                <!-- Buttons to toggle collapsible sections -->
                <p class="d-flex justify-content-start flex-wrap gap-3 mt-4">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#gcashInfo"
                        aria-expanded="false" aria-controls="gcashInfo">GCASH Account</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#bankInfo"
                        aria-expanded="false" aria-controls="bankInfo">BANK ACCOUNT</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#wuInfo"
                        aria-expanded="false" aria-controls="wuInfo">Western Union</button>
                </p>

                <!-- Collapsible sections  -->
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="collapse multi-collapse" id="gcashInfo">
                            <div class="card text-dark card-body">09958398848 Totoy B.</div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="collapse multi-collapse" id="bankInfo">
                            <div class="card text-dark card-body">Information about bank account donations will be
                                provided here.
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="collapse multi-collapse" id="wuInfo">
                            <div class="card text-dark card-body">Instructions for donating through Western Union
                                will
                                be shared
                                here.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-1 text-center" id="copy">2024 BCIF Santa Barbara. All rights reserved.</div>
    </div>


    <!-- JavaScript files -->
    <script src="../assets/bootstrap.bundle.min.js"></script>
</footer>

</body>

</html>