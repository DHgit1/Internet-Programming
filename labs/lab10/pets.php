<?php
    include 'inc/header.php';
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("pets");
    function getAllPets(){
        global $conn;
        $sql = "SELECT id, name, type FROM pets ORDER BY name";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
?>
<script>
    $(document).ready(function(){
        $("#adoptionsLink").addClass("active");
        $("#homeLink").removeClass("active");
        $(".petLink").click(function(){
            $('#myModal').modal("show");
            $("#petInfo").html("<img src='img/loading.gif'>");
            $.ajax({
                type: "GET",
                url: "api/getPetInfo.php",
                dataType: "json",
                data: { "id": $(this).attr("id")},
                success: function(data,status) {
                    $("#petInfo").html("");
                    $("#petModalLongTitle").html("<h2>"+ data.name +"</h2>");
                    $("#petInfo").append("<img src='img/"+ data.pictureURL +"' width='150' style='float:left'>");
                    $("#petInfo").append("Age: "+ data.age +" years <br>");
                    $("#petInfo").append("Breed: "+ data.breed +"<br>");
                    $("#petInfo").append(data.description+"<br>");
                    
                }
            });
        });
    });

</script>
<style>
    #adoptDiv {
        margin: 0 auto;
        width: 300px;
        height: 50px;
        position: relative;
        border: 1px solid black;
        text-align:left;
        padding-left: 10px;
    }
    #button {
        margin-top:5px;
        margin-right:5px;
        position: absolute;
        right: 0;
    }
</style>
<?php
    $petList = getAllPets();
    foreach ($petList as $pet) {
        echo "<div id='adoptDiv'>";
        echo "<button type='button' class='btn btn-primary' id='button'>Adopt Me!</button>";
        echo "Name: <a href='#' class='petLink' data-toggle='modal' data-target='#exampleModalCenter' id='".$pet['id']."'>" . $pet['name'] . "</a><br>";
        echo "Type: " . $pet['type'];
        echo "</div><br>";
    }
?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="petModalLongTitle">Modal title</h5>
      </div>
      <div id="petInfo"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>