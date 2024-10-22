<?php include ('navbarTop.php'); ?>

<style>
.circle-image {
    width: 120px;
    height: 120px;
    overflow: hidden;
    border-radius: 50%;
    margin: 0 auto;
}

.circle-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.ministry-card {
    padding: 20px;
}

/* Custom Styles for Carousel Indicators */
.carousel-indicators [data-bs-target] {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #007bff;
    /* Active color */
    opacity: 0.5;
    /* Default opacity */
}

.carousel-indicators .active {
    opacity: 1;
    /* Active dot opacity */
    background-color: #007bff;
    /* Active color */
}
</style>

<!-- About church section-->
<div class="container my-5">
    <h2 class="text-center mb-5">Our Ministry Leaders</h2>
    <div id="ministryCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#ministryCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#ministryCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#ministryCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner mb-5">
            <div class="carousel-item active">
                <div class="row text-center">
                    <!-- Ministry 1 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/raymond.png" class="img-fluid" alt="Head Pastor">
                            </div>
                            <h5 class="mt-2">Head Pastor</h5>
                            <p class="mb-3 fs-5 text-dark">Raymond Suamen</p>
                        </div>
                    </div>
                    <!-- Ministry 2 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/angel.png" class="img-fluid" alt="Children Ministry">
                            </div>
                            <h5 class="mt-2">Children's Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Angel Sumalapao</p>
                        </div>
                    </div>
                    <!-- Ministry 3 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/gigi.png" class="img-fluid" alt="Youth Ministry">
                            </div>
                            <h5 class="mt-2">Youth Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Gigi Diaz</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row text-center">
                    <!-- Ministry 4 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/jubert.png" class="img-fluid" alt="Outreach Ministry">
                            </div>
                            <h5 class="mt-2">Outreach Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Jubert Suganob</p>
                        </div>
                    </div>
                    <!-- Ministry 5 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/lilia.png" class="img-fluid" alt="Usher Ministry">
                            </div>
                            <h5 class="mt-2">Usher Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Lilia Supeña</p>
                        </div>
                    </div>
                    <!-- Ministry 6 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/mj.png" class="img-fluid" alt="Media Ministry">
                            </div>
                            <h5 class="mt-2">Media Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Mark John Patanindagat</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row text-center">
                    <!-- Ministry 7 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/crissa.png" class="img-fluid" alt="Dance Ministry">
                            </div>
                            <h5 class="mt-2">Dance Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Crissa Reyna</p>
                        </div>
                    </div>
                    <!-- Ministry 8 -->
                    <div class="col-md-4">
                        <div class="ministry-card">
                            <div class="circle-image">
                                <img src="../img/jeya.png" class="img-fluid" alt="Music Ministry">
                            </div>
                            <h5 class="mt-2">Music Ministry</h5>
                            <p class="mb-3 fs-5 text-dark">Jeya Rujean Pastorfide</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<br>
<!-- Organization section- -->
<div class="container-fluid my-5">
    <h2 class="text-center text-dark my-4">Our Affiliate Organizations</h2>
    <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <img src="../img/Bcc.jpg" class="card-img-top" alt="Image 1">
                            <div class="card-body">
                                <h5 class="card-title">Bethlehem Christian Church</h5>
                                <p class="card-text fs-5 text-dark text-justify">
                                    Located at the heart of the community, Bethlehem Christian Church has been a
                                    beacon of faith and service for many years. It is known for its dynamic worship
                                    services and strong emphasis on biblical teaching. The church actively participates
                                    in
                                    local outreach initiatives, spreading the love of Christ through charitable
                                    <span id="more1" class="d-none">spreading the love of Christ through charitable
                                        programs. Bethlehem Christian Church continues to be a
                                        spiritual home for those seeking growth in their walk with God.</span>
                                    <a href="javascript:void(0)" class="text-info" onclick="toggleText(1)"
                                        id="toggleBtn1">...Read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <img src="../img/pavia.jpg" class="card-img-top" alt="Image 2">
                            <div class="card-body">
                                <h5 class="card-title">BCIF Pavia</h5>
                                <p class="card-text fs-5 text-dark text-justify">
                                    BCIF Pavia is a growing church that emphasizes building a close-knit,
                                    family-oriented congregation. The church is deeply involved in outreach efforts
                                    within the local community. BCIF Pavia regularly organizes events that engage
                                    the
                                    youth, families, and the elderly.Through vibrant worship and discipleship
                                    programs,
                                    <span id="more2" class="d-none mx-auto">
                                        BCIF Pavia seeks to inspire and equip its members to live out their faith in
                                        everyday life.</span>
                                    <a href="javascript:void(0)" class="text-info" onclick="toggleText(2)"
                                        id="toggleBtn2">...Read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <img src="../img/sanmig.jpg" class="card-img-top" alt="Image 3">
                            <div class="card-body">
                                <h5 class="card-title">Bethlehem Church San Miguel</h5>
                                <p class="card-text fs-5 text-dark text-justify">
                                    Bethlehem Church San Miguel is a thriving congregation that upholds the values
                                    of
                                    faith, community, and service. The church is dedicated to nurturing spiritual
                                    growth
                                    through passionate worship and Bible-based teaching. It plays an active role in
                                    the
                                    San Miguel area by offering support to those in need.
                                    <span id="more3" class="d-none">Known for its warm and welcoming atmosphere, the
                                        church is a place where individuals and families can experience the love and
                                        presence of God.</span>
                                    <a href="javascript:void(0)" class="text-info" onclick="toggleText(3)"
                                        id="toggleBtn3">...Read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <img src="../img/raphah.png" class="card-img-top" alt="Image 4">
                            <div class="card-body">
                                <h5 class="card-title">Raphah Philippines</h5>
                                <p class="card-text fs-5 text-dark text-justify">
                                    Raphah Philippines is focused on healing and restoration, working with people in
                                    crisis situations. The ministry partners with various organizations and churches
                                    to
                                    provide counseling and support. Raphah Philippines aims to bring hope and
                                    healing to
                                    individuals and families.Raphah Philippines in partnership with various
                                    <span id="more4" class="d-none">
                                        Christian organizations and churches have prayer counseling centers and hubs
                                        who
                                        can provide help & services to people in need and located in Iloilo City,
                                        Sta.
                                        Barbara-Iloilo, Dumaguete, Bacolod, Roxas City, and in selected areas in
                                        Luzon,
                                        Visayas and Mindanao where our ministry partner, Center for Community
                                        Transformation (CCT) has its presence.</span>
                                    <a href="javascript:void(0)" class="text-info" onclick="toggleText(4)"
                                        id="toggleBtn4">...Read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleText(cardNumber) {
    const moreText = document.getElementById("more" + cardNumber);
    const toggleBtn = document.getElementById("toggleBtn" + cardNumber);

    if (moreText.classList.contains("d-none")) {
        moreText.classList.remove("d-none");
        toggleBtn.innerText = "Read less";
    } else {
        moreText.classList.add("d-none");
        toggleBtn.innerText = "...Read more";
    }
}
</script>

<?php include('footers.php'); ?>