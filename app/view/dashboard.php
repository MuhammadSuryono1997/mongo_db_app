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
                <td><?=$employ->departement[$i++]->dept_name?></td>
                <td>
                   <button class="btn btn-sm btn-primary">Edit</button>
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
                   <button class="btn btn-sm btn-primary">Edit</button>
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
            <input type="text" name='first_name' class="form-control" placeholder="Enter Departement Code"/>
        </div>
        <div class="form-group">
            <label>Last Name Name</label>
            <input type="text" name='last_name' class="form-control" placeholder="Enter Departement Name"/>
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