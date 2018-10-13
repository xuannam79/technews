<!-- Footer -->
<footer id="footer">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-5">
            <div class="footer-widget">
               <div class="footer-logo">
                  <a href="index.php" class="logo"><img src="/templates/public/img/Capture1.PNG" alt=""></a>
               </div>
               <div class="footer-copyright">
                  <span>
                     &copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Xuân Nam</a>
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  </span>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="row">
               <div class="col-md-6">
                  <div class="footer-widget">
                     <h3 class="footer-title">About Me</h3>
                     <ul class="footer-links">
                        <li><a href="/lien-he">Contacts</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="footer-widget">
                     <h3 class="footer-title">Catagories</h3>
                     <ul class="footer-links">
                        <?php 
                           $queryCat = "select * from cat";
                           $resultCat  = $mysqli->query($queryCat);
                           
                           while($arCat = mysqli_fetch_assoc($resultCat))
                           {
                           	$catID = $arCat['cat_id'];
                           	if($arCat['parent_id']==0){
                           		$urlCat = '/cat/'.utf8ToLatin($arCat['name']).'-'.$catID;
                           ?>
                        <li><a href="<?php echo $urlCat?>"><?php echo $arCat['name']?></a></li>
                        <?php }}?>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="footer-widget">
               <h3 class="footer-title">Join our Newsletter</h3>
               <div class="footer-newsletter">
                  <form>
                     <input class="input" type="email" name="newsletter" placeholder="Enter your email">
                     <button class="newsletter-btn"><i class="fa fa-paper-plane"></i></button>
                  </form>
               </div>
               <ul class="footer-social">
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
      <!--/row -->
   </div>
   <!--/container -->
</footer>
<!--/Footer -->
<!-- jQuery Plugins -->
<script src="/templates/public/js/jquery.min.js"></script>
<script src="/templates/public/js/bootstrap.min.js"></script>
<script src="/templates/public/js/main.js"></script>
</body>
</html>