<?php

// Aksi Departement
if(isset($_REQUEST['delete']))
{
    $data = (object)['dept_no'=>$_REQUEST['id']];
    $hapus = $dept->delete($data);
    if($hapus)
    {
        header('location:http://localhost:90/index.php/dashboard');
    }
}

if (isset($_POST['kode_departemen'])) 
{
    $data = (object)[
        'dept_no'=>$_POST['kode_departemen'],
        'dept_name'=>$_POST['nama_departemen']
    ];
    $dept->insert($data);
}

if (isset($_REQUEST['edit_dept'])) 
{
    $data = (object)[
        'dept_name' => $_POST['nama_departemen_edit']
    ];

    $id = (object)[
      'dept_no' => $_POST['kode_departemen_edit']
    ];

    $update = $dept->update($id, $data) ;
    if ($update == 'berhasil') {
      header('location:http://localhost:90/index.php/dashboard');
    }else{
      echo $dept->update($id, $data);
    }
}


// AKSI EMPLOYEES

if(isset($_REQUEST['delete_employe']))
{
    $data = (object)['emp_no'=>$_REQUEST['id']];
    $hapus = $emp->delete($data);
    if($hapus)
    {
        header('location:http://localhost:90/index.php/dashboard');
    }
}

if (isset($_POST['first_name'])) 
{
    $data = (object)[
        'emp_no'=> hash('md5','emp-'.time()),
        'first_name'=>$_POST['first_name'],
        'last_name'=>$_POST['last_name'],
        'dept_no'=>$_POST['departement_code']
    ];
    $emp->insert($data);
    
}

// echo "tes";
if (isset($_REQUEST['edit_employe'])) 
{
    $data = (object)[
        'first_name' => $_POST['first_name_edit'],
        'last_name' => $_POST['last_name_edit'],
        'dept_no' => $_POST['departement_code_edit']
    ];

    $id = (object)[
      'emp_no' => $_POST['id_emp']
    ];

    var_dump($data);

    $update = $emp->update($id, $data) ;
    if ($update == 'berhasil') {
      header('location:http://localhost:90/index.php/dashboard');
    }else{
      echo $emp->update($id, $data);
    }
}


$data_dept = $dept->get();
$data_emp = $emp->join();

// print_r($data_emp);
?>

<div class="col-lg-6">
    <div class="col-md-12">
        <button class="btn btn-info btn-flat btn-sm mb-3" data-toggle="modal" data-target="#employeeModal" style="box-shadow: 0px 7px 12px #888">Add Employees</button>
    <table class="table table-striped table-hover" style="box-shadow: 0px 7px 12px #888">
        <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Departemen</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $no =1;
                $i = 0;
                foreach($data_emp as $employ)
                {
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$employ->first_name." ".$employ->last_name?></td>
                <td><?=$employ->departement[0]->dept_name?></td>
                <td>
                   <button class="btn btn-sm btn-primary btn-edit-employe" data="<?=$employ->emp_no?>">Edit</button>
                   <a href="http://localhost:90/index.php/dashboard?delete_employe&id=<?=$employ->emp_no?>" class="btn btn-danger btn-sm">Delete</button>
               </td>
            </tr>
                <?php } ?>
        </tbody>
    </table>
    </div>
</div>

<div class="col-lg-6">
    <div class="col-md-12">
    <button class="btn btn-info btn-flat btn-sm mb-3" data-toggle="modal" data-target="#exampleModal" style="box-shadow: 0px 7px 12px #888">Add Departemen</button>
    <table class="table table-striped table-hover" style="box-shadow: 0px 7px 12px #888">
        <thead class="table-danger">
        <tr>
            <th>No</th>
            <th>Nama Departemen</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_dept as $data)
            {
            ?>
           <tr>
               <td><?=$no++?></td>
               <td><?=$data->dept_name?></td>
               <td>
                   <button class="btn btn-sm btn-primary" data='<?=$data->dept_no?>' id="btn-edit-dept">Edit</button>
                   <a href="http://localhost:90/index.php/dashboard?delete&id=<?=$data->dept_no?>" class="btn btn-danger btn-sm">Delete</button>
               </td>
           </tr>
           <?php } ?>
        </tbody>
    </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Departement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="http://localhost:90/index.php/dashboard" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Departement Code</label>
            <input type="text" name='kode_departemen' class="form-control" placeholder="Enter Departement Code"/>
        </div>
        <div class="form-group">
            <label>Departement Name</label>
            <input type="text" name='nama_departemen' class="form-control" placeholder="Enter Departement Name"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-sm btn-flat block">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Departement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="http://localhost:90/index.php/dashboard" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name='first_name' class="form-control" placeholder="Enter First Name"/>
        </div>
        <div class="form-group">
            <label>Last Name Name</label>
            <input type="text" name='last_name' class="form-control" placeholder="Enter Last Name"/>
        </div>
        <div class="form-group">
            <label>Departement</label>
            <select class="form-control" name='departement_code'>
                <option value="">Select Departement</option>
                <?php
                $dept_data = $dept->get();
                foreach ($dept_data as $depa) {
                    echo '<option value="'.$depa->dept_no.'">'.$depa->dept_name.'</option>';
                }
                ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-sm btn-flat block">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editDeptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Departement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="http://localhost:90/index.php/dashboard?edit_dept" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Departement Code</label>
            <input type="text" name='kode_departemen_edit' class="form-control edit_kode_dept" placeholder="Enter Departement Code"/>
        </div>
        <div class="form-group">
            <label>Departement Name</label>
            <input type="text" name='nama_departemen_edit' class="form-control edit_name_dept" placeholder="Enter Departement Name"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-sm btn-flat block">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="employeeEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Departement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="" class="form-edit-employe" method="POST">
      <div class="modal-body">
        <input type="hidden" name="id_emp" class='id_emp'/>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name='first_name_edit' class="form-control first_edit" placeholder="Enter Departement Code"/>
        </div>
        <div class="form-group">
            <label>Last Name Name</label>
            <input type="text" name='last_name_edit' class="form-control last_edit" placeholder="Enter Departement Name"/>
        </div>
        <div class="form-group">
            <label>Departement</label>
            <select class="form-control select_dept_edit" name='departement_code_edit'>
                <option value="">Select Departement</option>
                <?php
                $dept_data = $dept->get();
                foreach ($dept_data as $depa) {
                    echo '<option value="'.$depa->dept_no.'">'.$depa->dept_name.'</option>';
                }
                ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-sm btn-flat block">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script>
  $(document).ready(function()
  {
    $(document).on('click', '#btn-edit-dept', function(){
      var id = $(this).attr('data');
      // console.log(id);
      $.ajax({
          type: 'POST',
          url: 'http://localhost:90/coba.php?data-edit-depart',
          data: 
          {
            id: id
          },
          success: function(res)
          {
            // console.log(res);
            var data = JSON.parse(res);
            $('.edit_kode_dept').attr('value', data.dept_no);
            $('.edit_name_dept').attr('value', data.dept_name);
            $('#editDeptModal').modal('show');
          }
        })
    })

    $(document).on('click', '.btn-edit-employe', function()
    {
      var id= $(this).attr('data');
      $('.form-edit-employe').attr('action', 'http://localhost:90/index.php/dashboard?edit_employe&id');
      $.ajax({
          type: 'POST',
          url: 'http://localhost:90/coba.php?data-edit-employee',
          data: 
          {
            id: id
          },
          success: function(res)
          {
            var data = JSON.parse(res);
            $('.first_edit').attr('value', data.first_name);
            $('.last_edit').attr('value', data.last_name);
            $('.id_emp').attr('value', data.emp_no);
            $('#employeeEditModal').modal('show');
          }
        })
    })
  })
</script>