<?php error_reporting(E_ALL);
ini_set('display_errors', 1); include 'check.php'; $pageurl="webquery"; $tbl_name="dg_query"; $pagename="Website Query"; $mintablewidth="1000px";
 //if($_GET['startdate']!="") {$sdate=$_GET[startdate]; $edate=$_GET[enddate]; } else {$sdate="2019-04-01"; $edate=$newrd;} 
   
 if ($_POST['action'] == 'Delete') {
	for ($i=0; $i < count($_POST[ids]);$i++) {
  	$studentchapter1 =$_POST[ids][$i].", ".$studentchapter1;  }
	$ids = substr($studentchapter1, 0, -2);
$companyasend = str_replace(", ","' or ID = '", $ids);
	
$sql="DELETE FROM `$tbl_name` WHERE ID='$companyasend'";
if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error()); }
echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?startdate=$_GET[startdate]&enddate=$_GET[enddate]&paid=$_GET[paid]&batch=$_GET[batch]&page=$_GET[page]&message=$pagename deletd..'>";  exit(0);


} else if ($_POST['action'] == 'ON') { 
   	for ($i=0; $i < count($_POST[ids]);$i++) {
  	$studentchapter1 =$_POST[ids][$i].", ".$studentchapter1;   }
	$ids = substr($studentchapter1, 0, -2);

$companyasend = str_replace(", ","' or ID = '", $ids);
$sql="UPDATE `$tbl_name` SET status ='1' WHERE ID='$companyasend'";
if (!mysqli_query($con,$sql)) {die('Error: ' . mysqli_error()); }
echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?startdate=$_GET[startdate]&enddate=$_GET[enddate]&paid=$_GET[paid]&batch=$_GET[batch]&page=$_GET[page]&message=$pagename updated..'>";  exit(0);
	   
} else if ($_POST['action'] == 'OFF') {
   	for ($i=0; $i < count($_POST[ids]);$i++) {
  	$studentchapter1 =$_POST[ids][$i].", ".$studentchapter1;   }
	$ids = substr($studentchapter1, 0, -2);

$companyasend = str_replace(", ","' or ID = '", $ids);
$sql="UPDATE `$tbl_name` SET status ='0' WHERE ID='$companyasend'";
if (!mysqli_query($con,$sql)) {die('Error: ' . mysqli_error()); }
echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?startdate=$_GET[startdate]&enddate=$_GET[enddate]&paid=$_GET[paid]&batch=$_GET[batch]&page=$_GET[page]&message=$pagename updated..'>";  exit(0);
 
} else { ?>
	  
 <!DOCTYPE html>
<html>
  <head>  
    <meta charset="UTF-8">
	<title><?php echo $pagename ?></title>
		<?php include 'bootstrap.php' ; ?>
<style type="text/css">.mywidth1{width:100%; font-size:14px;}  @media (max-width: 799px) {.hidem{ display: none; visibility:hidden; } .mywidth1{width:600px;} } 
 .boxw {width:200px;} 
 @media (max-width: 480px) { .boxw{ width:200px; } } 
 </style>	
</head>
  <body class="<?php echo $skincolor ?>">
  <div id="non-printable">
    <div class="wrapper">
	<?php include 'header1.php'; ?> 
	<?php include 'leftmenu.php'; ?>     
     
      <div class="content-wrapper">
		 <section class="content-header hidem">          
          <ol class="breadcrumb">
            <li style="color:#EC0000;"><i class="fa fa-list"></i> <?php echo $headertext ?></a></li>
			<li class="active"><a href="<?php echo $pageurl ?>" style="color:#0000FF;"><?php echo $pagename ?></a></li>
          </ol>
        </section><div class="hidem"><br/></div>

	<section class="content">
          <div class='row'>
            <div class='col-xs-12'>
              <div class="nav-tabs-custom">
              	<div class="tab-content">
				<form name="find" action="" method="get">
<div class="box-header with-border" style="background-color: #E6E6E6; text-transform:uppercase;">
<table width="100%" border="0">  <tr>
    <td><font size="3"><b><?php echo $pagename ?></b> </font></td>
   
   
  <td align="right"><input type="text" name="search" id="search" style="width:220px; height:32px;border-radius:0px; border:1px solid #CCC; padding-left:5px;background: #FFF url('images/searchbg.gif') right no-repeat;" placeholder="Search" onKeyDown="if (event.keyCode == 13) { this.form.submit(); return false; }" value="<?php echo $_GET['search'] ?>" /></td>
   
  </tr>
</table>
</div></form>

<div style="height:5px;">&nbsp;</div>

		

<div class="row">
<div class="col-md-12">
<div style='overflow-x: auto;'> 
		 
		 <?php 
	 	$search = @$_GET['search']; 
	// How many adjacent pages should be shown on each side?
	$adjacents =10;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	
	// define the list of fields
    $fields = array('status');
    $conditions = array();

    // loop through the defined fields
    foreach($fields as $field){
        // if the field is set and not empty
        if($_GET[$field]!="") {
            // create a new condition while escaping the value inputed by the user (SQL Injection)
            $conditions[] = "$field='$_GET[$field]'";  // lhs side is column name of table while right side is get value from form..
			 //"find_in_set(`$field`,'".mysqli_real_escape_string($con,$_GET[$field])."') > 0" 
        }
}

    // builds the query

    if($_GET[search]!=""){
    $query = "SELECT COUNT(*) as num FROM `$tbl_name` WHERE userid='$userid'";	
    $sqlx = "SELECT * FROM `$tbl_name` WHERE userid='$userid'";

	} else {

	$query = "SELECT COUNT(*) as num FROM `$tbl_name` WHERE userid='$userid'";	
    $sqlx = "SELECT * FROM `$tbl_name` WHERE userid='$userid'";      }

    // if there are conditions defined
    if(count($conditions) > 0) {
        // append the conditions
        $query .= " and ". implode (' and ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
		$sqlx .= " and ". implode (' and ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
    }

    $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
	$total_pages = $total_pages['num'];
    $tnum = $total_pages;
	
/*	Setup vars for query. */
    $targetpage = "$pageurl?"; 	//your file name  (the name of this file)	
	$limit = 100; 								//how many items to show per page
	$page = @$_GET['page'];
	if ($_GET['page']=="" || $_GET[page]=="0" || $_GET['page']=="1") {
	$tnum = $total_pages;} else {$tnum = $total_pages-($limit*($_GET['page']-1));}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
    $sql=$sqlx." ORDER BY ID DESC LIMIT $start, $limit"; 		
    $result = mysqli_query($con,$sql);
 	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage&page=$prev\">&laquo;</a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo;</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage&page=$next\">&raquo;</font></a>";
		else
			$pagination.= "<span class=\"disabled\">&raquo;</span>";
		$pagination.= "</div>\n";		
	}
?>			 
	
	<?php if ($total_pages>="1"){?> 
		<form name="delete" id="frmCompare" class="frmCompare" action="<?php echo $pageurl ?>?startdate=<?php echo $sdate ?>&enddate=<?php echo $edate ?>&paid=<?php echo $_GET[paid] ?>&batch=<?php echo $_GET[batch] ?>&page=<?php echo $_GET[page] ?>" method="post"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px; font-family:Verdana, Geneva, sans-serif; min-width:<?php echo $mintablewidth ?>;" align="center">
    <tr height="35">
     <td width="200"><button name="action" value="Delete" style="background:none; border:none; cursor:pointer; height:20px; width:20px;" title="Delete" onClick="return verifCompare();"><img src="images/delete.png" title="Delete" /></button> <?php /*?>&nbsp; <button name="action" value="ON" style="background:none; border:none; cursor:pointer; height:20px; width:20px;" title="Active" onClick="return verifCompare();"><img src="images/green.png" title="Active" /></button> &nbsp; <button name="action" value="OFF" style="background:none; border:none; cursor:pointer; height:20px; width:20px;" title="Inactive" onClick="return verifCompare();"><img src="images/red.png" name="action"  style="cursor:pointer" value="OFF" title="Inactive" /></button><?php */?></td>	
	  <td><div class="toppage"><div class="nextpage"><?=$pagination?></div><div class="totalpage" align="right" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#666666; padding-right:10px;"><?php echo "Record = ".@$total_pages; ?></div></div></td>
     </tr>
</table>         



<?php
/////////// Now let us print the table headers ////////////////
echo "<TABLE width='100%' border=1 cellpadding=1 cellspacing=1 bgcolor='#CCC' align='center' id='tblData' style='min-width:$mintablewidth;'> 
<tr height='33' align='center' class='theader' bgcolor='#CCC' style='font-weight:bold;'>";
echo "<td width='60'>SN</td>";
echo "<td width='40'>#</td>";
echo "<td align='left' style='padding-left:10px;'>Member Details</td>";
echo "<td align='left' style='padding-left:10px;'>Query Details</td>";
echo "</tr>";

$in=0; while($row = mysqli_fetch_array($result)) {
$rdx=date("j M Y", strtotime($row['rd'])); 
			
$in=$in+1;	
if($bgcolor=='#F8F8FF'){$bgcolor='#ffffff';} else{$bgcolor='#F8F8FF';}  
echo "<tr bgcolor = '$bgcolor' class='tcontent' align='center' height='32' style='padding:10px;' >";
echo "<td style='padding:5px;' valign='top'><b>$tnum</b></td>";
echo "<td style='padding:5px;' valign='top'><input type='checkbox' class='td' name =ids[] value='$row[ID]' style='cursor:pointer;'></td>";

echo "<td align='left' style='padding:5px;' valign='top'><b>$row[name]</b><br />Mobile : $row[contact]</td>";
echo "<td align='left' style='padding:5px;' valign='top'><b>$row[subject]</b><br />$row[message]<br /><i style='color:#CCC;'>$row[createdon]</td>";
echo "</tr>";
$tnum=$tnum-1; 	 
}
echo "</table>"; 
?>
</form>
 <script type='text/javascript'>//<![CDATA[ 
var selected = $('#frmCompare :checkbox:checked').length;
function verifCompare() {
var agree=confirm("Are you sure to take the action...");	
	if (agree)
	return true ; else	
	return false ;  }

$(document).ready(function () {
$('#frmCompare :checkbox').change(function(){
  //update selected variable
  selected = $('#frmCompare :checkbox:checked').length

  if (selected >= 1) {
	  $('div#btnCompare').show(); }   else {
        $('div#btnCompare').hide();  }
});
});
</script> 
<br /><br />
 <?php } else { ?>
 <div align="center" class="nodata" style="padding-top:100px; padding-bottom:50px;"><img src="images/nodata.gif" /></div>
 <?php } ?>  
 		 
</div></div></div>				 
				 
				 
				
              </div> <!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
    <?php include 'footer.php'; ?>   
    </div><!-- ./wrapper -->
	</div>




	
	
	
<?php include 'plugin.php' ; ?>
	
	<script type="text/javascript">
$(document).ready(function()
{
$('#search').keyup(function()
{
searchdiv($(this).val());
});
});
function searchdiv(inputVal)
{
var table = $('#tblData');
table.find('tr').each(function(index, row)
{
var allCells = $(row).find('td');
if(allCells.length > 0)
{
var found = false;
allCells.each(function(index, td)
{
var regExp = new RegExp(inputVal, 'i');
if(regExp.test($(td).text()))
{
found = true;
return false;
}
});
if(found == true)$(row).show();else $(row).hide();
}
});
}
</script>	
  </body>
</html>
<?php }  ?>