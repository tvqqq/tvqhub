<?php $cv = get_post_meta(get_the_ID(), 'cv')[0]; ?>

<div class="row" id="page-me">
    <div class="col-12 col-lg-3 order-lg-last">
        <!-- Intro -->
        <div class="lds-css ng-scope">
            <div style="width:100%;height:100%" class="lds-facebook">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <img class="avatar-fb" src=""/>
        <h4 class="text-center">Tất Vĩ Quyền (TVQ)</h4>
        <div class="row text-muted d-flex flex-row justify-content-around">
            <span><i class="fas fa-map-marker-alt"></i> Saigonese</span>
            <span><i class="far fa-sun"></i> 22+</span>
            <span><i class="fas fa-horse-head"></i> Sagittarius</span>
        </div>
        <div class="links links-page-me">
            <ul class="social-link mb-3">
                <li><a href="https://www.facebook.com/tvqqq" target="_blank"><i
                            class="fab fa-facebook fa-2x"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="fb/tvqqq"></i></a></li>
                <li><a href="https://www.linkedin.com/in/tvq" target="_blank"><i
                            class="fab fa-linkedin fa-2x"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="in/tvq"></i></a></li>
                <li><a href="https://github.com/tvqqq" target="_blank"><i
                            class="fab fa-github fa-2x"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="github/tvqqq"></i></a></li>
                <li><a href="mailto:tvq9612@gmail.com" target="_blank"><i
                            class="fas fa-at fa-2x"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="tvq9612@gmail.com"></i></a></li>
            </ul>
        </div>
        <div class="text-center mt-3 button-cv">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                    data-target="#myCV">My
                CV <i class="fas fa-chevron-circle-right"></i>
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
                                        <strong>DOWNLOAD TatViQuyen-CV.pdf</strong>
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </p>
                            </object>
                        </div>
                    </div>
                </div>
            </div><!-- end modal-->
        </div>
        <hr/>
    </div>
    <div class="col-12 col-lg-9 order-lg-first">
        <!-- Content -->
        <div class="info">
            <h4>👋 Xin chào! Hello! 你好！</h4>
            <p>I am Quyen - a web developer, freelance designer from Ho Chi Minh City. I currently work as a <strong>PHP
                    developer</strong>, specializing in back-end web
                development for <a href="https://www.hdwebsoft.com/" target="_blank">HDWEBSOFT</a>.</p>
            <p>I am obsessed about Web Development, my main programming language is PHP and I also have basic knowledge
                about front-end, UI/UX, graphics design. I spend my
                time
                on learning coding, "googling" and solving problems to create awesome works.</p>
            <p>I create this blog for reinforcing my knowledge, challenging myself and sharing something I like. Other
                than coding, I love music, photography, and to travel
                across the world...🛵</p>
        </div>

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

        <h5><i class="fas fa-laptop"></i> Currently Using</h5>
        <ul>
            <li><strong>PC:</strong> i3 3240 - AMD R7 200 - 8GB - 128GB/500GB</li>
            <li><strong>Laptop:</strong> Thinkpad T430</li>
            <li><strong>Keyboard:</strong> Dareu DK87</li>
            <li><strong>Mouse:</strong> Logitech M90</li>
            <li><span class="text-muted">Updating...</span></li>
        </ul>

        <h5><i class="fab fa-bitbucket"></i> Bucket List</h5>
        <div class="custom-control custom-checkbox disabled">
            <input type="checkbox" class="custom-control-input">
            <label class="custom-control-label"><span class="text-muted">Updating...</span></label>
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
