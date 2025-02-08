<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    
    <li class="nav-item">
      <a class="nav-link collapsed" href="area_reports.php">
        <i class="bi bi-geo-alt"></i>
        <span>Area</span>
      </a>
    </li> 

    <li class="nav-item">
      <a class="nav-link collapsed" href="daily_collection_report.php">
        <i class="bi bi-file-earmark-spreadsheet"></i>
        <span>Daily Collection Report</span>
      </a>
    </li>

    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#waterRateSubmenu" aria-expanded="false" aria-controls="waterRateSubmenu">
        <i class="bi bi-moisture"></i>
        <span>Water Rate</span>
        <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
    </a>
    <ul id="waterRateSubmenu" class="collapse sidebar-submenu">
        <li>
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'water_rate_reports_residential.php') ? 'active' : ''; ?>" href="water_rate_reports_residential.php" onclick="event.stopPropagation();">
                <i class="bi <?php echo (basename($_SERVER['PHP_SELF']) == 'water_rate_reports_residential.php') ? 'bi-circle-fill shaded-circle' : 'bi-circle'; ?>"></i>
                <span>Residential</span>
            </a>
        </li>
        <li>
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'water_rate_reports_commercial.php') ? 'active' : ''; ?>" href="water_rate_reports_commercial.php" onclick="event.stopPropagation();">
                <i class="bi <?php echo (basename($_SERVER['PHP_SELF']) == 'water_rate_reports_commercial.php') ? 'bi-circle-fill shaded-circle' : 'bi-circle'; ?>"></i>
                <span>Commercial</span>
            </a>
        </li>
    </ul>
</li>






    <li class="nav-item">
      <a class="nav-link collapsed" href="meter_replacement.php">
        <i class="bi bi-speedometer2"></i>
        <span>Meter Replacement</span>
      </a>
    </li>

     <li class="nav-item">
      <a class="nav-link collapsed" href="disconnected_reports.php">
        <i class="bi bi-droplet-half"></i>
        <span>Disconnected</span>
      </a>
    </li> 

    <li class="nav-item">
      <a class="nav-link collapsed" href="active_reports.php">
        <i class="bi bi-graph-up-arrow"></i>
        <span>Active</span>
      </a>
    </li> 

    <li class="nav-item">
      <a class="nav-link collapsed" href="new_connection_reports.php">
        <i class="bi bi-command"></i>
        <span>New Connection </span>
      </a>
    </li> 


    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="statement_of_account_reports.php">
        <i class="bi bi-person-lines-fill"></i>
        <span>Statement of Account</span>
      </a>
    </li>  -->
    <li class="nav-item">
    <a class="nav-link collapsed" href="statement_of_account_reports.php" target="_blank">
        <i class="bi bi-person-lines-fill"></i>
        <span>Statement of Account</span>
    </a>
</li>



    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#materials-submenu" aria-expanded="false" aria-controls="materials-submenu">
        <i class="bi bi-screwdriver"></i>
        <span>Materials Inventory</span>
        <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
      </a>
      <ul id="materials-submenu" class="collapse sidebar-submenu">
        <li>
          <a class="nav-link" href="raw_materials_reports.php">
            <i class="bi bi-circle"></i>
            <span>Particulars</span>
          </a>
        </li>
        <li>
          <a class="nav-link" href="new_delivery_reports.php">
            <i class="bi bi-circle"></i>
            <span>New delivery</span>
          </a>
        </li>
      </ul>
    </li>End Materials Inventory Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="collectors_profile_reports.php">
        <i class="bi bi-person-workspace"></i>
        <span>Collector's Profile</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="members_profile_reports.php">
        <i class="bi bi-people-fill"></i>
        <span>Members Profile</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="reading_reports_visor.php">
        <i class="bi bi-gear-wide-connected"></i>
        <span>Reading Reports</span>
      </a>
    </li> 


<!-- 
    <li class="nav-item">
      <a class="nav-link collapsed" href="inventory_reports.php">
        <i class="bi bi-file-earmark-spreadsheet"></i>
        <span>Inventory Reports / ANNEX Reports</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link collapsed" href="production_reports.php">
        <i class="bi bi-rulers"></i>
        <span>Production Measurements</span>
      </a>
    </li>

    
    <li class="nav-item">
      <a class="nav-link collapsed" href="customer_manager_reports.php">
        <i class="bi bi-people"></i>
        <span>Customer Manager</span>
      </a>
    </li>


    
    <li class="nav-item">
      <a class="nav-link collapsed" href="chlorine_monitoring_reports.php">
        <i class="bi bi-moisture"></i>
        <span>Chlorine Monitoring</span>
      </a>
    </li> --> 


  </ul>
</aside>
<!-- End Sidebar -->
