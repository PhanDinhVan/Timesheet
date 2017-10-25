
<style>
    .agenda {}
    /* Dates */
    
    .agenda .agenda-date {
        width: 170px;
    }
    
    .agenda .agenda-date .dayofmonth {
        width: 40px;
        font-size: 36px;
        line-height: 36px;
        float: left;
        text-align: right;
        margin-right: 10px;
    }
    
    .agenda .agenda-date .shortdate {
        font-size: 0.75em;
    }
   
</style>



<table class="table table-condensed table-bordered" id="tab2" style="display: none;">
    <thead>
        <tr>
            <th id="dayofweek_change"></th>
        </tr>
        <tr style="text-align: center; font-size: 14px;">
            <td>Project name</td>
            <td>Task name</td>
            <td>Working time</td>
            <td>Over time</td>
            <td>Date</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody id="ajax_data">
        
    </tbody>
</table>