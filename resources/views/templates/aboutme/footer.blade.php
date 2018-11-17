      <!-- footer -->
      <footer class="main-footer">
        &COPY; 2018 Ninh Văn Nghĩa
      </footer><!-- footer -->
    </div><!-- body-area -->


    <!-- portfolio details ajax -->
    <div class="over-fly-area" id="load-works">
      <div class="inner-overfly" id="work-wait-msg">
        <div class="middle-overfly">
          <h2 class="title-over">PLEASE WAIT...</h2>
        </div>
      </div>
      <div class="work-close"><a href="#" class="close-panel-work btn btn-xs btn-default" >Close</a></div>
      <div id="load-work-html" ></div>
    </div>
    <!-- Modal Example-->
   

    <div id="fb-livechat-msg" class="fix_tel">
      <div class="ring-alo-phone ring-alo-green ring-alo-show" id="ring-alo-phoneIcon" style="right: 150px; bottom: -12px;">
        <div class="ring-alo-ph-circle"></div>
        <div class="ring-alo-ph-circle-fill"></div>
        <div class="ring-alo-ph-img-circle">
          <a href="#" onclick="return showfbmsg()">
            <img class="lazy" src="{{$publicUrl}}/assets/theme/img/513QyICz-NL.png" alt="">
            </a>
        </div>
        </div>
      </div>

    <div id="fb-livechat" class="fb-livechat animated bounceInUp hidden-xs">
      <div class="modal-content">
        <div id="modal-header-fb" class="modal-header">
          <button type="button" class="" aria-label="Close" title="Đóng" onclick="return removeFacebookLiveChat();"><span aria-hidden="true">Close</span></button>
        </div><i class="fab fa-facebook-messenger"></i>
        <div id="modal-body-fb" class="modal-body">
          <div class="fb-page" data-href="https://www.facebook.com/NinhNghiait-591783441203982/" data-tabs="messages" data-width="300" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/NinhNghiait-591783441203982/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/NinhNghiait-591783441203982/">NinhNghiait</a></blockquote>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{$publicUrl}}/assets/external/jquery.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/jquery.easing-1.3.pack.js"></script>

    <!-- Include all compiled plugins (below)-->
    <script src="{{$publicUrl}}/assets/external/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/jquery.easypiechart.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/isotope.pkgd.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/validator/jquery.validate.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/simpleCaptcha/jquery.simpleCaptcha.js"></script>
    <script src="{{$publicUrl}}/assets/external/Simple-Ajax-Uploader/SimpleAjaxUploader.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{$publicUrl}}/assets/external/metisMenu/metisMenu.js"></script>

    <!-- theme config --> 
    <script src="{{$publicUrl}}/assets/theme/js/theme.js"></script>

    <!-- map --> 
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script> 
    <script src="{{$publicUrl}}/assets/external/gmap3.min.js"></script>
    <script src="{{$publicUrl}}/assets/theme/js/map.js"></script>
    <script src="{{$publicUrl}}/assets/theme/js/sweetalert.min.js"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    @yield ('js')
    <script>
      $('#fb-livechat').hide();
      function showfbmsg() {
        $('#fb-livechat').show();
        $('#fb-livechat-msg').hide();
      }
      function removeFacebookLiveChat() {
    $('#fb-livechat').addClass('bounceOutDown');
    // $('#fb-livechat').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $('#fb-livechat').hide();
        $('#fb-livechat-msg').show();
    // });
    }
    </script>
  </body>
</html>