<!-- FOOTER -->
<footer class="bg-dark text-white">
  <div class="container">
    <!--DIV of ROW will occupy whole width/AREA -->
    <div class="row">
      <!--DIV of col will have 12 columnsf which must be specifies accordingly like col-md5/col-md6 et  c..............-->
      <div class="col">
        <!--Custom JS query CALLED BY """ID""" created below  -->
      <p class="text-center"> By | Rakshit Patel | <span id="year"></span> &copy; </p>
       </div>
     </div>
  </div>
</footer>
    <div style="height:10px; background:#27aae1;"></div>
<!-- FOOTER END-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!--writting custom javascript for getting the current year and calling it ABOVE by """"ID""""-->
<script>
$('#year').text(new Date().getFullYear());
</script>
</body>
</html>
