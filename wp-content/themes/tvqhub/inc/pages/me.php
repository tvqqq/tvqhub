<?php $cv = get_post_meta(get_the_ID(), 'cv', true); ?>

<div class="row" id="page-me">
    <div class="col-12 col-lg-3 order-lg-last text-center">
        <!-- Intro -->
        <div class="lds-css ng-scope">
            <div style="width:100%;height:100%" class="lds-facebook">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <img class="avatar-fb" src=""/>
        <h3>Tất Vĩ Quyền (TVQ)</h3>
        <div class="row text-muted d-flex flex-row me-info">
            <span><i class="fas fa-map-marker-alt"></i> Saigonese</span>
            <span><i
                    class="far fa-sun"></i> <?php echo date_diff(date_create(date('Y-m-d')), date_create('1996-12-17'))->y ?>+</span>
            <span><i class="fas fa-horse-head"></i> Sagittarius</span>
        </div>
        <div class="mt-3 button-cv">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                    data-target="#myCV">My CV <i class="fas fa-chevron-circle-right"></i>
            </button>
            <div class="modal fade" id="myCV" tabindex="-1" role="dialog"
                 aria-labelledby="myCVLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <object width="100%" height="900" data="<?= $cv ?>">
                                <p>Your web browser doesn't have a PDF plugin.
                                    You can download the PDF file.<br/><i class="fas fa-arrow-circle-down"></i>
                                    <a href="<?= $cv ?>"
                                       class="btn btn-outline-primary mt-3 mb-1">
                                        <strong>DOWNLOAD CV</strong>
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </p>
                            </object>
                        </div>
                    </div>
                </div>
            </div><!-- end modal-->
        </div>
    </div>
    <div class="col-12 col-lg-9 order-lg-first mt-4 mt-lg-0">
        <!-- Content -->
        <div class="info">
            <h4>👋 Xin chào! Hello! 你好！</h4>
            <p>I am Quyen - a web developer, freelance designer from Ho Chi Minh City. I currently work as a <strong>PHP
                    developer</strong>, specializing in back-end web development.</p>
            <p>I am obsessed about Web Development, my main programming language is PHP and I also have basic knowledge
                about front-end, UI/UX, graphics design. I spend my time on learning coding, "googling" and solving
                problems to create the awesome works.</p>
            <p>I create this blog for reinforcing my knowledge, challenging myself and sharing something I like. Other
                than coding, I love music, photography, and travelling across the world...🛵</p>
        </div>

        <h5><i class="fas fa-laptop"></i> Currently Using</h5>
        <ul>
            <li><strong>Laptop:</strong> Macbook Pro 2019 13" 1.4Ghz</li>
            <li><strong>Smartphone:</strong> Apple iPhone 11</li>
            <li><span class="text-muted">Updating...</span></li>
        </ul>

        <h5><i class="fas fa-stream"></i> Timeline</h5>
        <div class="timeline">
            <div class="container-timeline right">
                <div class="content">
                    <strong>1996 - </strong>
                    <span>Born in Ho Chi Minh City.</span>
                </div>
            </div>
            <div class="container-timeline right">
                <div class="content">
                    <strong>20xx - </strong>
                    <span class="text-muted">Updating...</span>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    jQuery(function ($) {
        $.get('https://graph.facebook.com/100009259293856?fields=picture.width(720).height(720)', function (data) {
            $('img.avatar-fb').attr('src', data.picture.data.url);
            $('.lds-css').hide();
        });
    });
</script>
