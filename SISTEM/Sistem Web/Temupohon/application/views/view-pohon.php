<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-view-pohon.css') ?>">
<h1 align="center">Lihat Data Pohon</h1>
<div id="content" align="center">
<?php 
	echo 
	"<div class='responsive'>
	<div class='img'>
	<img width='300' height='200' alt='No Picture' src='".base_url()."/assets/images/uploads/gambarPohon/".$query['nama_gambar']."?rand=".rand(900,22)."'>
	</div>
	</div>
	";
 ?>	
 <div id="myModal" class="modal">
  <span class="close">x</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
 <hr>
 <table>
 	<tr>
 		<td class="th-vertical">Nama Pohon</td>
 		<td><?php echo $query['nama_pohon'] ?></td>
 	</tr>
 	<tr>
 		<td class="th-vertical">Nama Latin</td>
 		<td><?php echo $query['nama_latin'] ?></td>
 	</tr>
 	<tr>
 		<td class="th-vertical">Sinonim</td>
 		<td><?php echo $query['sinonim'] ?></td>
 	</tr>
  <tr>
    <td class="th-vertical">Perawakan</td>
    <td><?php echo $query['perawakan'] ?></td>
  </tr>
 	<tr>
 		<td class="th-vertical">Biologi</td>
 		<td><?php echo $query['biologi'] ?></td>
 	</tr>
    <tr>
    <td class="th-vertical">Habitat</td>
    <td><?php echo $query['habitat'] ?></td>
  </tr>
    <tr>
    <td class="th-vertical">Potensi</td>
    <td><?php echo $query['potensi'] ?></td>
  </tr>
 	<tr>
 		<td class="th-vertical">Status Konservasi</td>
 		<td><?php echo $query['status_konservasi'] ?></td>
 	</tr>
 	<tr>
 		<td class="th-vertical">Persebaran</td>
 		<td><?php echo $query['persebaran'] ?></td>
 	</tr>
  <tr>
    <td class="th-vertical">Ditambahkan Oleh:</td>
    <td><?php echo $query['add_by'] ?></td>
  </tr>
 </table>
<a id="btn-back" href="<?php echo base_url('UserPage') ?>">Back</a>
 
</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}

// Get all images and insert the clicked image inside the modal
// Get the content of the image description and insert it inside the modal image caption
var images = document.getElementsByTagName('img');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
var i;
for (i = 0; i < images.length; i++) {
   images[i].onclick = function(){
       modal.style.display = "block";
       modalImg.src = this.src;
       modalImg.alt = this.alt;
       captionText.innerHTML = this.nextElementSibling.innerHTML;
   }
}
</script>


</body>