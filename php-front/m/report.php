<?php
$query="SELECT cluster.department,cluster.batch,cluster.section,cluster.sub_section,form.faculty_id,form.feedback_code,form.faculty_desc FROM cluster INNER JOIN access INNER JOIN form WHERE cluster.access_code=access.access_code AND access.feedback_code=form.feedback_code";
// echo $query;
$resultaccess=mysqli_query($conn,$query);
?>
<table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Department</th>
                    <th>Batch</th>
                    <th>Section</th>
                    <th>Feedback Form</th>
                    <th>Faculty</th>
                    <th>Subject</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
<?php
$i=1;
while($rowaccess = $resultaccess->fetch_assoc())
{
    $feedback_code = $rowaccess['feedback_code'];
    $feedback_desc = getdescription($conn,"feedback",$feedback_code);
    $faculty_id = $rowaccess['faculty_id'];
    $faculty_name = getdescription($conn,"username",$faculty_id);
    $faculty_desc = $rowaccess['faculty_desc'];
    $feedback_data=getconsolidatedfbdata($conn,$faculty_id,$feedback_code,$feedback_params);
    ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo htmlspecialchars($rowaccess['department']); ?></td>
                    <td><?php echo htmlspecialchars($rowaccess['batch']); ?></td>
                    <td><?php echo htmlspecialchars($rowaccess['section']); ?></td>
                    <td><?php echo $feedback_desc; ?></td>
                    <td><?php echo $faculty_name."(".$faculty_id.")"; ?></td>
                    <td><?php echo $faculty_desc; ?></td>
                    <td><?php
                    $n=$feedback_data['n'];
                    $ratio= $feedback_data['total']/((($n==0)?1:$n)*sizeof($feedback_params)*$feedback_data['y-max']);
                    echo substr($ratio*10,0,5);
                    ?></td>
                </tr>
<?php 
$i++;
}
?>
            </tbody>
        </table>
