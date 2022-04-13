<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="box-footer info-contact">
					<h3>Thông tin liên hệ</h3>
					<div class="content-contact">
						<p>Trường Cao Đẳng Công nghệ Thủ Đức</p>
						<p>
							<strong>Địa chỉ:</strong> 53 Võ Văn Ngân, Linh Chiểu, Thủ Đức, Thành phố Hồ Chí Minh
						</p>
						<p>
							<strong>Email: </strong> fit.tdc@edu.tdc.vn
						</p>
						<p>
							<strong>Điện thoại: </strong> 028 3897 0023
						</p>
						<p>
							<strong>Website: </strong> http://fit.tdc.edu.vn/
						</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="box-footer info-contact">
					<h3>Thông tin khác</h3>
					<div class="content-list">
					<?php wp_nav_menu(
									array(
										'theme_location' => 'footer-menu',
										'container' => 'false',
										'menu_id' => 'footer-menu',
										'menu_class' => 'footer-menu',
									)
								); ?>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="box-footer info-contact">
					<h3>Form liên hệ</h3>
					<div class="content-contact">
					<form action="/shopcongnghe/lien-he/#wpcf7-f14-p80-o1" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="14">
<input type="hidden" name="_wpcf7_version" value="5.3.2">
<input type="hidden" name="_wpcf7_locale" value="vi">
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f14-p80-o1">
<input type="hidden" name="_wpcf7_container_post" value="80">
<input type="hidden" name="_wpcf7_posted_data_hash" value="">
</div>
<hr>
<div class="row">
<div class="col-md-4">
    <span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" placeholder="Tên"></span>
  </div>
<div class="col-md-4">
    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control" aria-required="true" aria-invalid="false" placeholder="Email"></span>
  </div>
<div class="col-md-4">
    <span class="wpcf7-form-control-wrap your-subject"><input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text form-control" aria-invalid="false" placeholder="Tiêu đề"></span>
  </div>
</div>
<p> <!-- end of .row --></p>
<hr>
<div class="row">
<div class="col-md-12">
    <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-control" aria-invalid="false" placeholder="Nội dung"></textarea></span>
  </div>
</div>
<hr>
<div class="row">
<div class="col-sm-12">
    <input type="submit" value="Gửi đi" class="wpcf7-form-control wpcf7-submit btn-block btn btn-primary btn-lg"><span class="ajax-loader"></span>
  </div>
</div>
<div class="wpcf7-response-output" aria-hidden="true"></div></form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright">
		<p>Copyright © 2020 Nhóm 12 - Design by TDCFIT</p>
	</div>
</footer>
</div>
<script src="<?php bloginfo('template_directory'); ?>/libs/jquery-3.4.1.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=193897272342328&autoLogAppEvents=1" nonce="4evBLozA"></script>
<?php wp_footer(); ?>
</body>

</html>