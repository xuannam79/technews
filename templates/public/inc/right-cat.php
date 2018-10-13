<!-- catagories -->
<div class="aside-widget">
   <div class="section-title">
      <h2>Danh mục</h2>
   </div>
   <div class="category-widget">
      <ul>
         <?php 
            $queryCat = "select * from cat";
            $resultCat  = $mysqli->query($queryCat);
            
            while($arCat = mysqli_fetch_assoc($resultCat))
            {
            	$parent_id = $arCat['parent_id'];
            	$catID = $arCat['cat_id'];
            	
            	if($arCat['status']==1){
            	if($parent_id==0){
            		$queryTST = "select COUNT(*) as 'TST' FROM news n INNER JOIN cat c on n.cat_id=c.cat_id WHERE n.cat_id={$catID} or c.parent_id={$catID}";
            		$resultTST  = $mysqli->query($queryTST);
            		if($arTST = mysqli_fetch_assoc($resultTST)){
            		
            	$urlCat = '/cat/'.utf8ToLatin($arCat['name']).'-'.$catID;
            ?>
         <li style="height: 105px; margin: 30px 5px;">
            <a href="<?php echo $urlCat?>" class="cat-<?php echo $arCat['color']?>"><?php echo $arCat['name']?><span><?php echo $arTST['TST']?></span></a>
            <ul style="list-style-type: circle;">
               <?php 
                  $queryCat1 = "select * from cat where parent_id = {$catID}";
                  $resultCat1  = $mysqli->query($queryCat1);
                  while($arCat1 = mysqli_fetch_assoc($resultCat1)){
                  	if($arCat1['status']==1){
                  	$parent_id = $arCat1['cat_id'];
                  	$queryTST2 = "select COUNT(*) as 'TST2' FROM news n INNER JOIN cat c on n.cat_id=c.cat_id WHERE n.cat_id={$parent_id} or c.parent_id={$parent_id}";
                  	$resultTST2  = $mysqli->query($queryTST2);
                  	if($arTST2 = mysqli_fetch_assoc($resultTST2)){
                  	$urlCat1 = '/cat/'.utf8ToLatin($arCat1['name']).'-'.$parent_id;
                  ?>
               <li style="height: 20px;margin: 10px 40px;">
                  <a href="<?php echo $urlCat1?>"><?php echo $arCat1['name']?><span><?php echo $arTST2['TST2']?></span> </a>
               </li>
               <?php }}}?>
            </ul>
         </li>
         <?php }}}}?>
      </ul>
   </div>
</div>
<!--/catagories -->