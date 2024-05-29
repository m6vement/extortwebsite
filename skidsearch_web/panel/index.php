<?PHP
//error_reporting(0);
session_start();
if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit();
}
?>
<html>
        <head>
                <title>SkidSearch</title>
                <link rel="stylesheet prefetch" href="https://fonts.googleapis.com/css?family=Montserrat:400,800">
                <link rel="stylesheet prefetch" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
                <link rel="stylesheet" href="css/main.css">
                <link rel="stylesheet" href="style.css">
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        </head>

        <body>
                <nav class="navtop">
                        <div>
                            <h1></h1>
                            <a href="https://discord.gg/tvYUFQaT2w"><i class="fab fa-discord"></i>Discord</a>
                            <a href="removals.php"><i class="fas fa-trash-alt"></i>IP Removals</a>
                            <a href="faq.php"><i class="fas fa-info-circle"></i>FAQ</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                </nav>
                <!--<div id="notificaton-banner">
                            <a href="https://skidsearch.net/mipt_ru.sql">Moscow Institute of Physics and Technology Database #StandWithUkraine</a>&nbsp;&nbsp;&nbsp;<a id="close">[X]</a>
                </div>--!>
                <div class="wrapper">
                        <div class="clip-text header"><a href="https://skidsearch.net/index.php">SKIDSEARCH</a></div>
                        <div class="search">
                                <div class="panel panel-info purple">
                                        <div class="panel-heading">
                                                <h3 class="panel-title">Database Search Engine</h3>
                                        </div>
                                        <div class="panel-body">
                                                <form method="POST">
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <label>Search Term:</label>
                                                                        <input class="form-control" name="query" required="" autocomplete="off">
                                                                </div>
                                                                <div class="col-xs-6">
                                                                        <label>Search Type:</label>
                                                                        <select class="form-control" name="method" required="" placeholder="">
                                                                                <option value="username">Username</option>
                                                                                <option value="uuid">UUID</option>
                                                                                <option value="ip_address">IP Address</option>
                                                                                <option value="email">Email</option>
                                                                                <option value="password">Password</option>
                                                                                <option value="steamid">Steam ID</option>
                                                                        </select>
                                                                </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <br>
                                                                        <button class="btn btn-success btn-block" type="submit">Search</button>
                                                                </div>
                                                        </div>
                                                </form>
                                                <?PHP
                                                        $con = mysqli_connect("localhost", "root", "password", "SkidSearch") or die("Error connecting to database.");

                                                        $tables = array("02_2020_IPs", "AdeptMC_IPs", "Alpha_TS3_Cloud_IPs", "AnarchyHCF_IPs", "Andysolam", "AntiCentral_IPs",
                                                                        "Arcane_Teamspeak_IPs", "Arivi_IPs", "Astro_IPs", "AstroPVP_IPs", "Aus-Craft_Emails", "AveHC_IPs",
                                                                        "BattleMade_Forums", "BiteForce_IPs", "BlizzardMC_IPs", "Brawl_IPs", "BreachPVP_IPs", "Buzzplex_Emails",
                                                                        "CandyPVP_Emails", "CannonNetwork_IPs", "CaveLight_IPs", "CavePVP_IPs", "CentrixPVP_Emails", "ChaoticMC_IPs", "ChillZone", "ChooChoosMC_Emails", "ClassyPW_IPs",
                                                                        "Clyro_IPs", "CobraPVP_IPs", "ColdNetwork_IPs", "CosmicPrisons_Buycraft", "CosmicPrisons_IPs", "CosmicPVP_Forum", "CosmicPVP_IPs_Part_1", "CosmicPVP_IPs_Part_2", "CosmicPVP_IPs_Part_3",
                                                                        "CosmicPVP_IPs_Part_4", "CosmicPVP_IPs_Part_5", "CosmicPVP_IPs_Part_6", "CosmicPVP_Teamspeak_IPs", "CraftBlock_Emails",
                                                                        "CrownMe_IPs", "DCUniverse_IPs", "DaedricMC_IPs", "DarceCraft_Forum", "DatPixel_Emails", "DecimatePVP_Emails", "DesiredCraft_IPs",
                                                                        "Desteria_IPs", "Dior_Teamspeak_IPs", "Doxbin", "DripMC_IPs", "DupeMC_IPs", "EagleHCF_IPs", "EagleHCF_IPs_2019", "EmpireMinecraft_Emails",
                                                                        "EnchantsMC_IPs", "EscapeRestart_Emails", "EvntClub_IPs", "FactionsHub_IPs", "FactionsLab_Emails", "FactionsLab_Fringe_Map_11", "FactionsLab_IPs", "FactionsZone_IPs",
                                                                        "FaithfulHCF_IPs", "FaithfulHCF_TS", "FaithfulMC_IPs_Sept_2020", "Falcun_Client", "Fastly_Teamspeak_IPs", "FierceFactions_IPs",
                                                                        "Fiona_IPs", "FluctisHosting_User_Yosh2k19_IPs", "FluctisHosting_User_abrasmit_IPs", "FluctisHosting_User_aitodor2_IPs",
                                                                        "FluctisHosting_User_juanfria_IPs", /*"FreakyVille_IPs",*/ "FrontierNetwork_IPs", "FunCraft_Forums", "GoaCraft_Emails", "HCGames_IPs", "HCKnights_IPs",
                                                                        "HavocRaids_IPs", "HolyHCF_IPs", "Hoodlums_Teamspeak_IPs", "HydraPVP_IPs", "HylastMC_IPs", "Hylast_IPs", "Hyverse_IPs",
                                                                        "ImpulseCraft_IPs", "InvasionPVP_IPs", "Iratus_IPs", "JackpotMC_IPs", "JawsPVP_IPs", "JurassicPVP_IPs", "Kishar_IPs", "Levaria_IPs", "LimitlessMC_IPs",
                                                                        "Longshot_Buycraft", "Loverfellas_IPs", "MangoRust_IPs", "Mars_Teamspeak_IPs", "MCRivals_IPs", "MCCentral_IPs", "ManifestMC_IPs", "MapleCraft_IPs", "MapleCraft_Private",
                                                                        "MilXRust_IPs", "Minefest_Prison_IPs", "MineManClub_IPs", "MineSharp_IPs", "MineagePVP_IPs", "MinecraftStresser_DB", "MortalMC_IPs", "MurderRIP_IPs",
                                                                        "Oculate_IPs", "OlympusMC_IPs", "OpticCraft_IPs", "OstiaPVP_IPs", "OxPVP_IPs", "PVPLabs_IPs", "PVPGlobe_IPs", "PVPWars_Emails", "ParallaxMC_IPs", "PickleServers_IPs",
                                                                        "PotLand_IPs", "RainHCF_IPs", "RankedBedwars_IPs", "RankedBedwars_Registration", "RavenMC_IPs", "RealRaidz_IPs", "ReaperMC_IPs", "RedeSky", "ReflexMC_IPs", "RoyalCraft_IPs",
                                                                        "RoyaltyPVP_Emails", "RoyaltyPVP_IPs", "RustAcademy", "RustEmpires", "SacrificeMC_IPs", "SaiCoPVP_IPs_Part_1", "SaiCoPVP_IPs_Part_2", "SaiCoPVP_IPs_Part_3",
                                                                        "SaiCoPVP_IPs_Part_4", "SaicoPVP_Buycraft", "Sarefine_IPs", "Shotbow_Emails", "SirenCraft_IPs", "SilexPVP_IPs", "SpainPVP_Emails",
                                                                        "SpellPVP_IPs", "StellarPVP_IPs", "StormyMC_IPs", "StrideZone_IPs", "StrivePVP_IPs", "TeamSpeak_DB_Compilation", "TheBigDigMC_Emails",
                                                                        "Towelliee_Emails", "Trexic_IPs", "Triad_IPs", "Unknown_Database", "ValidHCF_IPs", "VanityMC_IPs", "VardenGalaxy_IPs",
                                                                        "VeltPVP_Emails", "VeltPVP_IPs", "VenomPVP_IPs", "VerilHQ_IPs", "VerixPVP_Factions_IPs", "VerixPVP_Skyblock_IPs", "ViperMC_IPs",
                                                                        "VitalityHCF_IPs", "VortexRust", "Vysteria_IPs", "WaffleMinecraft_Emails", "WarfareMC_IPs", "Warfine_IPs", "WaveHCF_IPs", "WenjaHCF_IPs",
                                                                        "WinterMC_IPs", "Yahoo_DB", "ZetHC_IPs", "ZetMC_IPs", "Zolus_IPs", "Zolux_IPs", "iPvP_IPs", "nUg_IPs", "ythc_IPs");
                                                        
                                                        $tableelements = count($tables);
                                                        $tableiterator = 0;
                                                        
                                                        $noresults = "
                                                        __________________________________________
                                                        <p>No Results.</p>
                                                        ";

                                                        if(isset($_POST['query']) && isset($_POST['method'])) {
                                                                // Define POST's
                                                                $query = $_POST['query'];
                                                                $method = $_POST['method'];
                                                                // Securing query
                                                                $query = htmlspecialchars($query); // changes characters used in html to their equivalents, for example: < to &gt;
                                                                $query = mysqli_real_escape_string($con, $query); // makes sure nobody uses SQL injection
                                                                // Securing method
                                                                $method = htmlspecialchars($method);
                                                                $method = mysqli_real_escape_string($con, $method);

                                                                if(strlen($query) == 0) {
                                                                        die();
                                                                }

                                                                echo "<div class='search-results'>";
                                                                if($method == "username") {
                                                                    foreach($tables as $table) {
                                                                        $stmt = $con->prepare("SELECT * FROM {$table} WHERE username = ?");
                                                                        if($stmt == False) {
                                                                            continue;
                                                                        }
                                                                        $stmt->bind_param('s', $query);
                                                                        $stmt->execute();
                                                                        $results = $stmt->get_result();

                                                                        if($results->num_rows === 0) {
                                                                            ++$tableiterator;
                                                                        } else {
                                                                            while($data = $results->fetch_assoc()) {
                                                                                echo "__________________________________________";
                                                                                echo "<p>";
                                                                                echo "<br>";
                                                                                if($table == "CobraPVP_IPs" || $table == "ChaoticMC_IPs" || $table == "ManifestMC_IPs" || $table == "ReaperMC_IPs" || $table == "MapleCraft_Private" || $table == "MCRivals_IPs" || $table == "OlympusMC_IPs" || $table == "SirenCraft_IPs") {
                                                                                    echo "Database: [Unnamed Breach]";
                                                                                } else {
                                                                                    echo "Database: [".str_replace("_", " ", $table)."]";
                                                                                }
                                                                                echo "<br>";
                                                                                
                                                                                if(array_key_exists("date", $data)) {
                                                                                    echo htmlspecialchars("Date: {$data['date']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("username", $data)) {
                                                                                    echo htmlspecialchars("Username: {$data['username']}");
                                                                                    echo "<br>";                                                                                   
                                                                                }
                                                                                if(array_key_exists("uuid", $data)) {
                                                                                    echo htmlspecialchars("UUID:     {$data['uuid']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("email", $data)) {
                                                                                    echo htmlspecialchars("Email:    {$data['email']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("ip_address", $data)) {
                                                                                    echo htmlspecialchars("IP:       {$data['ip_address']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("password", $data)) {
                                                                                    echo htmlspecialchars("Password: {$data['password']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                echo "</p>";
                                                                            }
                                                                        }
                                                                        
                                                                        if($tableelements == $tableiterator) {
                                                                            echo $noresults;
                                                                        }
                                                                    }

                                                                       // Logging variables
                                                                    $user = $_SESSION['name'];
                                                                    $search_type = "username";
                                                                    $search = $query;
                                                                    $when_searched = time();
                                                                    $queried_from = $_SERVER["HTTP_CF_CONNECTING_IP"];

                                                                    $stmt->close(); // close previous prepared statement

                                                                    $con->select_db("SkidSearchUsers"); // select logging db
                                                                    $stmt = $con->prepare("INSERT INTO SearchLogs (user, search_type, search, when_searched, queried_from) VALUES (?, ?, ?, ?, ?)");
                                                                    $stmt->bind_param('sssis', $user, $search_type, $search, $when_searched, $queried_from);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                } elseif($method == "uuid") {
                                                                    foreach($tables as $table) {
                                                                        $stmt = $con->prepare("SELECT * FROM {$table} WHERE uuid = ?");
                                                                        if($stmt == False) {
                                                                            continue;
                                                                        }
                                                                        $stmt->bind_param('s', $query);
                                                                        $stmt->execute();
                                                                        $results = $stmt->get_result();

                                                                        if($results->num_rows === 0) {
                                                                            ++$tableiterator;
                                                                        } else {
                                                                            while($data = $results->fetch_assoc()) {
                                                                                echo "__________________________________________";
                                                                                echo "<p>";
                                                                                echo "<br>";
                                                                                if($table == "CobraPVP_IPs" || $table == "ChaoticMC_IPs" || $table == "ManifestMC_IPs" || $table == "ReaperMC_IPs" || $table == "MapleCraft_Private" || $table == "MCRivals_IPs" || $table == "OlympusMC_IPs" || $table == "SirenCraft_IPs") {
                                                                                    echo "Database: [Unnamed Breach]";
                                                                                } else {
                                                                                    echo "Database: [".str_replace("_", " ", $table)."]";
                                                                                }
                                                                                echo "<br>";
                                                                                
                                                                                if(array_key_exists("date", $data)) {
                                                                                    echo htmlspecialchars("Date: {$data['date']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("username", $data)) {
                                                                                    echo htmlspecialchars("Username: {$data['username']}");
                                                                                    echo "<br>";                                                                                   
                                                                                }
                                                                                if(array_key_exists("uuid", $data)) {
                                                                                    echo htmlspecialchars("UUID:     {$data['uuid']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("email", $data)) {
                                                                                    echo htmlspecialchars("Email:    {$data['email']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("ip_address", $data)) {
                                                                                    echo htmlspecialchars("IP:       {$data['ip_address']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("password", $data)) {
                                                                                    echo htmlspecialchars("Password: {$data['password']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                echo "</p>";
                                                                            }
                                                                        }
                                                                        
                                                                        if($tableelements == $tableiterator) {
                                                                            echo $noresults;
                                                                        }
                                                                    }
                                                                    
                                                                    // Logging variables
                                                                    $user = $_SESSION['name'];
                                                                    $search_type = "uuid";
                                                                    $search = $query;
                                                                    $when_searched = time();
                                                                    $queried_from = $_SERVER["HTTP_CF_CONNECTING_IP"];

                                                                    $stmt->close(); // close previous prepared statement

                                                                    $con->select_db("SkidSearchUsers"); // select logging db
                                                                    $stmt = $con->prepare("INSERT INTO SearchLogs (user, search_type, search, when_searched, queried_from) VALUES (?, ?, ?, ?, ?)");
                                                                    $stmt->bind_param('sssis', $user, $search_type, $search, $when_searched, $queried_from);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                } elseif($method == "ip_address") {
                                                                    foreach($tables as $table) {
                                                                        $stmt = $con->prepare("SELECT * FROM {$table} WHERE ip_address = ?");
                                                                        if($stmt == False) {
                                                                            continue;
                                                                        }
                                                                        $stmt->bind_param('s', $query);
                                                                        $stmt->execute();
                                                                        $results = $stmt->get_result();

                                                                        if($results->num_rows === 0) {
                                                                            ++$tableiterator;
                                                                        } else {
                                                                            while($data = $results->fetch_assoc()) {
                                                                                echo "__________________________________________";
                                                                                echo "<p>";
                                                                                echo "<br>";
                                                                                if($table == "CobraPVP_IPs" || $table == "ChaoticMC_IPs" || $table == "ManifestMC_IPs" || $table == "ReaperMC_IPs" || $table == "MapleCraft_Private" || $table == "MCRivals_IPs" || $table == "OlympusMC_IPs" || $table == "SirenCraft_IPs") {
                                                                                    echo "Database: [Unnamed Breach]";
                                                                                } else {
                                                                                    echo "Database: [".str_replace("_", " ", $table)."]";
                                                                                }
                                                                                echo "<br>";
                                                                                
                                                                                if(array_key_exists("date", $data)) {
                                                                                    echo htmlspecialchars("Date: {$data['date']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("username", $data)) {
                                                                                    echo htmlspecialchars("Username: {$data['username']}");
                                                                                    echo "<br>";                                                                                   
                                                                                }
                                                                                if(array_key_exists("uuid", $data)) {
                                                                                    echo htmlspecialchars("UUID:     {$data['uuid']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("email", $data)) {
                                                                                    echo htmlspecialchars("Email:    {$data['email']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("ip_address", $data)) {
                                                                                    echo htmlspecialchars("IP:       {$data['ip_address']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("password", $data)) {
                                                                                    echo htmlspecialchars("Password: {$data['password']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                echo "</p>";
                                                                            }
                                                                        }
                                                                        
                                                                        if($tableelements == $tableiterator) {
                                                                            echo $noresults;
                                                                        }
                                                                    }
                                                                    // Logging variables
                                                                    $user = $_SESSION['name'];
                                                                    $search_type = "ip_address";
                                                                    $search = $query;
                                                                    $when_searched = time();
                                                                    $queried_from = $_SERVER["HTTP_CF_CONNECTING_IP"];

                                                                    $stmt->close(); // close previous prepared statement

                                                                    $con->select_db("SkidSearchUsers"); // select logging db
                                                                    $stmt = $con->prepare("INSERT INTO SearchLogs (user, search_type, search, when_searched, queried_from) VALUES (?, ?, ?, ?, ?)");
                                                                    $stmt->bind_param('sssis', $user, $search_type, $search, $when_searched, $queried_from);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                } elseif($method == "email") {
                                                                    foreach($tables as $table) {
                                                                        $stmt = $con->prepare("SELECT * FROM {$table} WHERE email = ?");
                                                                        if($stmt == False) {
                                                                            continue;
                                                                        }
                                                                        $stmt->bind_param('s', $query);
                                                                        $stmt->execute();
                                                                        $results = $stmt->get_result();

                                                                        if($results->num_rows === 0) {
                                                                            ++$tableiterator;
                                                                        } else {
                                                                            while($data = $results->fetch_assoc()) {
                                                                                echo "__________________________________________";
                                                                                echo "<p>";
                                                                                echo "<br>";
                                                                                if($table == "CobraPVP_IPs" || $table == "ChaoticMC_IPs" || $table == "ManifestMC_IPs" || $table == "ReaperMC_IPs" || $table == "MapleCraft_Private" || $table == "MCRivals_IPs" || $table == "OlympusMC_IPs" || $table == "SirenCraft_IPs") {
                                                                                    echo "Database: [Unnamed Breach]";
                                                                                } else {
                                                                                    echo "Database: [".str_replace("_", " ", $table)."]";
                                                                                }
                                                                                echo "<br>";
                                                                                
                                                                                if(array_key_exists("date", $data)) {
                                                                                    echo htmlspecialchars("Date: {$data['date']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("username", $data)) {
                                                                                    echo htmlspecialchars("Username: {$data['username']}");
                                                                                    echo "<br>";                                                                                   
                                                                                }
                                                                                if(array_key_exists("uuid", $data)) {
                                                                                    echo htmlspecialchars("UUID:     {$data['uuid']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("email", $data)) {
                                                                                    echo htmlspecialchars("Email:    {$data['email']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("ip_address", $data)) {
                                                                                    echo htmlspecialchars("IP:       {$data['ip_address']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("password", $data)) {
                                                                                    echo htmlspecialchars("Password: {$data['password']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                echo "</p>";
                                                                            }
                                                                        }
                                                                        
                                                                        if($tableelements == $tableiterator) {
                                                                            echo $noresults;
                                                                        }
                                                                    }
                                                                    // Logging variables
                                                                    $user = $_SESSION['name'];
                                                                    $search_type = "email";
                                                                    $search = $query;
                                                                    $when_searched = time();
                                                                    $queried_from = $_SERVER["HTTP_CF_CONNECTING_IP"];

//                                                                    $stmt->close(); // close previous prepared statement

                                                                    $con->select_db("SkidSearchUsers"); // select logging db
                                                                    $stmt = $con->prepare("INSERT INTO SearchLogs (user, search_type, search, when_searched, queried_from) VALUES (?, ?, ?, ?, ?)");
                                                                    $stmt->bind_param('sssis', $user, $search_type, $search, $when_searched, $queried_from);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                } elseif($method == "password") {
                                                                    foreach($tables as $table) {
                                                                        $stmt = $con->prepare("SELECT * FROM {$table} WHERE password = ?");
                                                                        if($stmt == False) {
                                                                            continue;
                                                                        }
                                                                        $stmt->bind_param('s', $query);
                                                                        $stmt->execute();
                                                                        $results = $stmt->get_result();

                                                                        if($results->num_rows === 0) {
                                                                            ++$tableiterator;
                                                                        } else {
                                                                            while($data = $results->fetch_assoc()) {
                                                                                echo "__________________________________________";
                                                                                echo "<p>";
                                                                                echo "<br>";
                                                                                if($table == "CobraPVP_IPs" || $table == "ChaoticMC_IPs" || $table == "ManifestMC_IPs" || $table == "ReaperMC_IPs" || $table == "MapleCraft_Private" || $table == "MCRivals_IPs" || $table == "OlympusMC_IPs" || $table == "SirenCraft_IPs") {
                                                                                    echo "Database: [Unnamed Breach]";
                                                                                } else {
                                                                                    echo "Database: [".str_replace("_", " ", $table)."]";
                                                                                }
                                                                                echo "<br>";
                                                                                
                                                                                if(array_key_exists("username", $data)) {
                                                                                    echo htmlspecialchars("Username: {$data['username']}");
                                                                                    echo "<br>";                                                                                   
                                                                                }
                                                                                if(array_key_exists("uuid", $data)) {
                                                                                    echo htmlspecialchars("UUID:     {$data['uuid']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("email", $data)) {
                                                                                    echo htmlspecialchars("Email:    {$data['email']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("ip_address", $data)) {
                                                                                    echo htmlspecialchars("IP:       {$data['ip_address']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("password", $data)) {
                                                                                    echo htmlspecialchars("Password: {$data['password']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                echo "</p>";
                                                                            }
                                                                        }
                                                                        
                                                                        if($tableelements == $tableiterator) {
                                                                            echo $noresults;
                                                                        }
                                                                    }
                                                                    // Logging variables
                                                                    $user = $_SESSION['name'];
                                                                    $search_type = "password";
                                                                    $search = $query;
                                                                    $when_searched = time();
                                                                    $queried_from = $_SERVER["HTTP_CF_CONNECTING_IP"];

                                                                    $stmt->close(); // close previous prepared statement

                                                                    $con->select_db("SkidSearchUsers"); // select logging db
                                                                    $stmt = $con->prepare("INSERT INTO SearchLogs (user, search_type, search, when_searched, queried_from) VALUES (?, ?, ?, ?, ?)");
                                                                    $stmt->bind_param('sssis', $user, $search_type, $search, $when_searched, $queried_from);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                } elseif($method == "steamid") {
                                                                    foreach($tables as $table) {
                                                                        $stmt = $con->prepare("SELECT * FROM {$table} WHERE steamid = ?");
                                                                        if($stmt == False) {
                                                                            continue;
                                                                        }
                                                                        $stmt->bind_param('s', $query);
                                                                        $stmt->execute();
                                                                        $results = $stmt->get_result();

                                                                        if($results->num_rows === 0) {
                                                                            ++$tableiterator;
                                                                        } else {
                                                                            while($data = $results->fetch_assoc()) {
                                                                                echo "__________________________________________";
                                                                                echo "<p>";
                                                                                echo "<br>";
                                                                                if($table == "CobraPVP_IPs" || $table == "ChaoticMC_IPs" || $table == "ManifestMC_IPs" || $table == "ReaperMC_IPs" || $table == "MapleCraft_Private" || $table == "MCRivals_IPs" || $table == "OlympusMC_IPs" || $table == "SirenCraft_IPs") {
                                                                                    echo "Database: [Unnamed Breach]";
                                                                                } else {
                                                                                    echo "Database: [".str_replace("_", " ", $table)."]";
                                                                                }
                                                                                echo "<br>";
                                                                                
                                                                                if(array_key_exists("steamid", $data)) {
                                                                                    echo htmlspecialchars("Steam ID: {$data['steamid']}");
                                                                                    echo "<br>";                                                                                   
                                                                                }
                                                                                if(array_key_exists("server", $data)) {
                                                                                    echo htmlspecialchars("Server:     {$data['server']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                if(array_key_exists("ip_address", $data)) {
                                                                                    echo htmlspecialchars("IP:       {$data['ip_address']}");
                                                                                    echo "<br>";
                                                                                }
                                                                                echo "</p>";
                                                                            }
                                                                        }
                                                                        
                                                                        if($tableelements == $tableiterator) {
                                                                            echo $noresults;
                                                                        }
                                                                    }
                                                                    // Logging variables
                                                                    $user = $_SESSION['name'];
                                                                    $search_type = "steamid";
                                                                    $search = $query;
                                                                    $when_searched = time();
                                                                    $queried_from = $_SERVER["HTTP_CF_CONNECTING_IP"];

//                                                                    $stmt->close(); // close previous prepared statement

                                                                    $con->select_db("SkidSearchUsers"); // select logging db
                                                                    $stmt = $con->prepare("INSERT INTO SearchLogs (user, search_type, search, when_searched, queried_from) VALUES (?, ?, ?, ?, ?)");
                                                                    $stmt->bind_param('sssis', $user, $search_type, $search, $when_searched, $queried_from);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                } else {
                                                                    die('Go fuck yourself loser');
                                                                }
                                                                echo "</div>";
                                                            }
                                                                    
                                                ?>
                                        </div>
                                </div>
                                <br>
                                <div class="panel panel-info purple">
                                        <div class="panel-heading">
                                                <h3 class="panel-title">Username To UUID Converter</h3>
                                        </div>
                                        <div class="panel-body">
                                                <form method="POST">
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <label>Username:</label>
                                                                        <input class="form-control" name="username-query" required="" autocomplete="off">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <br>
                                                                        <button class="btn btn-success btn-block" type="submit">Convert</button>
                                                                </div>
                                                        </div>
                                                </form>
                                                <?PHP
                                                        include '../mctools.php';

                                                        if(isset($_POST['username-query'])) {
                                                                // Define Posts
                                                                $query = $_POST['username-query'];
                                                                // Securing query
                                                                $query = htmlspecialchars($query); // changes characters used in html to their equivalents, for example: < to &gt;
                                                                // Convert Username to UUID using function from 'mctools.php'
                                                                $result = username_to_uuid($query);
                                                                // Add '-'s to the UUID, making it searchable
                                                                $result = format_uuid($result);

                                                                if(strlen($query) == 0) {
                                                                        die();
                                                                }

                                                                echo "<div class='converter-results'>";
                                                                echo "__________________________________________";
                                                                echo "<p>";
                                                                if(strlen($result) == 0) {
                                                                    echo "No Results Found.";
                                                                } else {
                                                                    echo htmlspecialchars("UUID:     {$result}");
                                                                }
                                                                echo "</p>";
                                                                echo "</div>";
                                                        }
                                                ?>
                                                
                                        </div>
                                </div>
                                <br>
                                <div class="panel panel-info purple">
                                        <div class="panel-heading">
                                                <h3 class="panel-title">Steam URL Converter</h3>
                                        </div>
                                        <div class="panel-body">
                                                <form method="POST">
                                                        <div class="col-md-12 col-sm-12">
                                                                <label>Steam Vanity:</label>
                                                                <input class="form-control" name="steam-convert" required="" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <br>
                                                                        <button class="btn btn-success btn-block" type="submit">Convert</button>
                                                                </div>
                                                        </div>
                                                </form>
                                                <?PHP
                                                        $accesstoken = "STEAMAPIKEY";

                                                        if(isset($_POST['steam-convert'])) {
                                                                // Define Posts
                                                                $query = $_POST['steam-convert'];
                                                                // Securing query
                                                                //$query = htmlspecialchars($query); // changes characters used in html to their equivalents, for example: < to &gt;
                                                                
                                                                if(strlen($query) == 0) {
                                                                        die();
                                                                }

                                                                //if(filter_var($query, FILTER_VALIDATE_IP) !== false) {
                                                                        $ch = curl_init();

                                                                        curl_setopt($ch, CURLOPT_URL, 'http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key='.$accesstoken.'&vanityurl='.$query);
                                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
                                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                                                        $response = curl_exec($ch);
                                                                        curl_close($ch);

                                                                        $results = json_decode($response, true);

                                                                        echo "<div class='steam-results'>";
                                                                        echo "__________________________________________";
                                                                        echo "<p>";
                                                                        if($results['response']['success'] != 1) {
                                                                            echo "Invalid Steam Vanity URL!";
                                                                        } else {
                                                                            echo htmlspecialchars("Steam ID: {$results['response']['steamid']}");
                                                                        }
                                                                        echo "<br>";
                                                                        echo "</p>";
                                                                        echo "</div>";
                                                                /*} else {
                                                                        die();
                                                                }*/
                                                        }
                                                ?>
                                        </div>
                                </div>
                                <br>
                                <div class="panel panel-info purple">
                                        <div class="panel-heading">
                                                <h3 class="panel-title">IP Geolocator</h3>
                                        </div>
                                        <div class="panel-body">
                                                <form method="POST">
                                                        <div class="col-md-12 col-sm-12">
                                                                <label>IP Address:</label>
                                                                <input class="form-control" name="geo-ip" required="" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <br>
                                                                        <button class="btn btn-success btn-block" type="submit">Locate</button>
                                                                </div>
                                                        </div>
                                                </form>
                                                <?PHP
                                                        $accesstoken = "IPINFO_API_KEY";

                                                        if(isset($_POST['geo-ip'])) {
                                                                // Define Posts
                                                                $query = $_POST['geo-ip'];
                                                                // Securing query
                                                                $query = htmlspecialchars($query); // changes characters used in html to their equivalents, for example: < to &gt;
                                                                
                                                                if(strlen($query) == 0) {
                                                                        die();
                                                                }

                                                                if(filter_var($query, FILTER_VALIDATE_IP) !== false) {
                                                                        $ch = curl_init();

                                                                        curl_setopt($ch, CURLOPT_URL, 'http://ipinfo.io/'.$query.'?token='.$accesstoken);
                                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
                                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                                                        $response = curl_exec($ch);
                                                                        curl_close($ch);

                                                                        $results = json_decode($response, true);

                                                                        echo "<div class='geo-ip-results'>";
                                                                        echo "__________________________________________";
                                                                        echo "<p>";
                                                                        echo htmlspecialchars("IP: {$results['ip']}");
                                                                        echo "<br>";
                                                                        echo htmlspecialchars("ISP: {$results['org']}");
                                                                        echo "<br>";
                                                                        if(strlen($results['hostname']) !== 0) {
                                                                                echo htmlspecialchars("Hostname: {$results['hostname']}");
                                                                                echo "<br>";
                                                                        }
                                                                        echo htmlspecialchars("City: {$results['city']}");
                                                                        echo "<br>";
                                                                        echo htmlspecialchars("Region: {$results['region']}");
                                                                        echo "<br>";
                                                                        echo htmlspecialchars("Country: {$results['country']}");
                                                                        echo "<br>";
                                                                        if(strlen($results['postal']) !== 0) {
                                                                                echo htmlspecialchars("ZIP: {$results['postal']}");
                                                                        }
                                                                        echo "</p>";
                                                                        echo "</div>";
                                                                } else {
                                                                        die();
                                                                }
                                                        }
                                                ?>
                                        </div>
                                </div>
                                <br>
                                <div class="panel panel-info purple">
                                        <div class="panel-heading">
                                                <h3 class="panel-title">VPN Checker</h3>
                                        </div>
                                        <div class="panel-body">
                                                <form method="POST">
                                                        <div class="col-md-12 col-sm-12">
                                                                <label>IP Address:</label>
                                                                <input class="form-control" name="vpncheck" required="" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                                <div class="col-xs-6">
                                                                        <br>
                                                                        <button class="btn btn-success btn-block" type="submit">Check</button>
                                                                </div>
                                                        </div>
                                                </form>
                                                <?PHP
                                                        if(isset($_POST['vpncheck'])) {
                                                                // Define Posts
                                                                $query = $_POST['vpncheck'];
                                                                // Securing query
                                                                $query = htmlspecialchars($query); // changes characters used in html to their equivalents, for example: < to &gt;
                                                                
                                                                if(strlen($query) == 0) {
                                                                        die();
                                                                }

                                                                if(filter_var($query, FILTER_VALIDATE_IP) !== false) {
                                                                        $content = file_get_contents("VPN_CHECK_API");
                                                                        if($content === "1") {
                                                                            echo "<div class='vpncheck-results'>";
                                                                            echo "__________________________________________";
                                                                            echo "<p>";
                                                                            echo htmlspecialchars("The IP: {$query}");
                                                                            echo "</br>HAS been detected as a VPN.";
                                                                            echo "</p>";
                                                                            echo "</div>";
                                                                        } else {
                                                                            echo "<div class='vpncheck-results'>";
                                                                            echo "__________________________________________";
                                                                            echo "<p>";
                                                                            echo htmlspecialchars("The IP: {$query}");
                                                                            echo "</br>Has NOT been detected as a VPN.";
                                                                            echo "</p>";
                                                                            echo "</div>";
                                                                        }
                                                                } else {
                                                                        die();
                                                                }
                                                        }
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </body>
        <!--<script>
             close = document.getElementById("close");
             close.addEventListener('click', function() {
               notificaton = document.getElementById("notificaton-banner");
               notificaton.style.display = 'none';
             }, false);
        </script>-->
        
</html>
