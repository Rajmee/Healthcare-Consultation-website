<style>
  #uni_modal .modal-footer {
    display: none;
  }
</style>
<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM doctors_schedule where doc_id =" . $_GET['did']);
$c = $qry->num_rows;
while ($row = $qry->fetch_assoc()) {
  $id[$row['day']] = $row['id'];
  $from[$row['day']] = date("H:i", strtotime($row['time_from']));
  $to[$row['day']] = date("H:i", strtotime($row['time_to']));
}


?>
<div class="container-fluid">
  <form id="manage-schedule">
    <input type="hidden" name="doctor_id" value="<?php echo $_GET['did'] ?>">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center"></th>
                <th class="text-center">Day</th>
                <th class="text-center">From</th>
                <th class="text-center">To</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
              for ($i = 0; $i < 7; $i++) :
              ?>
                <tr>
                  <td class=""><input type="checkbox" name="check[<?php echo $i ?>]" value="<?php echo isset($id[$days[$i]]) ? $id[$days[$i]] : '' ?>" <?php echo isset($id[$days[$i]]) ? "checked" : ($c > 0 ? '' : 'checked') ?>></td>
                  <td class=""><?php echo $days[$i] ?> <input type="hidden" name="days[<?php echo $i ?>]" value="<?php echo $days[$i] ?>"></td>
                  <td class="text-center"><input name="time_from[<?php echo $i ?>]" type="time" value="<?php echo isset($from[$days[$i]]) ? $from[$days[$i]] : '' ?>" class="form-control" id=""></td>
                  <td class="text-center"><input name="time_to[<?php echo $i ?>]" type="time" value="<?php echo isset($to[$days[$i]]) ? $to[$days[$i]] : '' ?>" class="form-control" id=""></td>
                </tr>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <button class="btn btn-primary btn-sm col-md-3 mr-2">Save</button>
        <button class="btn btn-secondary btn-sm col-md-3  " type="button" data-dismiss="modal" id="">Close</button>
      </div>
    </div>
  </form>
</div>

<script>
  $("#manage-schedule").submit(function(e) {
    e.preventDefault()
    start_load()
    $.ajax({
      url: 'ajax.php?action=save_schedule',
      method: "POST",
      data: $(this).serialize(),
      success: function(resp) {
        if (resp == 1) {
          alert_toast("Data successfully saved", "success");
          var title = $("#uni_modal .modal-title").html();
          title.replace("Edit ", '')
          end_load()
          uni_modal(title, 'view_doctor_schedule.php?id=<?php echo $_GET['did'] ?>')
        }
      }
    })
  })
</script>