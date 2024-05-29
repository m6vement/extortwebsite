<?PHP
    error_reporting(0);
    // GLOBAL VARIABLES //
    $key = array("SkidSearchAPI-IntelX", "SkidSearchAPI-LFTM-1TonyChenx", "SkidSearchAPI-resist");
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "password";
    $db_name = "SkidSearch";
    $db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // LIST OF DB's
    $tables = array("02_2020_IPs", "AdeptMC_IPs", "Alpha_TS3_Cloud_IPs", "AnarchyHCF_IPs", "AntiCentral_IPs", "Arcane_Teamspeak_IPs", "Arivi_IPs", "Astro_IPs", "AstroPVP_IPs", "Aus-Craft_Emails", "AveHC_IPs", "BattleMade_Forums", "BiteForce_IPs", "BlizzardMC_IPs", "Brawl_IPs", "BreachPVP_IPs", "Buzzplex_Emails", "CandyPVP_Emails", "CannonNetwork_IPs", "CaveLight_IPs", "CavePVP_IPs", "CentrixPVP_Emails", "ChooChoosMC_Emails", "ClassyPW_IPs", "Clyro_IPs", "ColdNetwork_IPs", "CosmicPVP_Forum", "CosmicPVP_IPs_Part_1", "CosmicPVP_IPs_Part_2", "CosmicPVP_IPs_Part_3", "CosmicPVP_IPs_Part_4", "CosmicPVP_IPs_Part_5", "CosmicPVP_IPs_Part_6", "CosmicPVP_Teamspeak_IPs", "CraftBlock_Emails", "CrownMe_IPs", "DCUniverse_IPs", "DaedricMC_IPs", "DarceCraft_Forum", "DatPixel_Emails", "DecimatePVP_Emails", "DesiredCraft_IPs", "Desteria_IPs", "Dior_Teamspeak_IPs", "DripMC_IPs", "DupeMC_IPs", "EagleHCF_IPs", "EagleHCF_IPs_2019", "EmpireMinecraft_Emails", "EnchantsMC_IPs", "EscapeRestart_Emails", "FactionsLab_Emails", "FactionsLab_Fringe_Map_11", "FactionsLab_IPs", "FactionsZone_IPs", "FaithfulHCF_IPs", "FaithfulHCF_TS", "FaithfulMC_IPs_Sept_2020", "Falcun_Client", "Fastly_Teamspeak_IPs", "FierceFactions_IPs", "Fiona_IPs", "FluctisHosting_User_Yosh2k19_IPs", "FluctisHosting_User_abrasmit_IPs", "FluctisHosting_User_aitodor2_IPs", "FluctisHosting_User_juanfria_IPs", "FrontierNetwork_IPs", "FunCraft_Forums", "GoaCraft_Emails", "HCGames_IPs", "HCKnights_IPs", "HavocRaids_IPs", "HolyHCF_IPs", "Hoodlums_Teamspeak_IPs", "HydraPVP_IPs", "HylastMC_IPs", "Hylast_IPs", "Hyverse_IPs", "ImpulseCraft_IPs", "InvasionPVP_IPs", "Iratus_IPs", "JawsPVP_IPs", "JurassicPVP_IPs", "Kishar_IPs", "Levaria_IPs", "LimitlessMC_IPs", "Longshot_Buycraft", "Mars_Teamspeak_IPs", "MCRivals_IPs", "MCCentral_IPs", "MapleCraft_IPs", "MapleCraft_Private", "Minefest_Prison_IPs", "MineManClub_IPs", "MineSharp_IPs", "MineagePVP_IPs", "MinecraftStresser_DB", "MortalMC_IPs", "MurderRIP_IPs", "Oculate_IPs", "OlympusMC_IPs", "OpticCraft_IPs", "OstiaPVP_IPs", "OxPVP_IPs", "PVPGlobe_IPs", "PVPWars_Emails", "ParallaxMC_IPs", "PotLand_IPs", "RainHCF_IPs", "RavenMC_IPs", "RealRaidz_IPs", "ReaperMC_IPs", "RedeSky", "ReflexMC_IPs", "RoyalCraft_IPs", "RoyaltyPVP_Emails", "RoyaltyPVP_IPs", "SacrificeMC_IPs", "SaiCoPVP_IPs_Part_1", "SaiCoPVP_IPs_Part_2", "SaiCoPVP_IPs_Part_3", "SaiCoPVP_IPs_Part_4", "SaicoPVP_Buycraft", "Sarefine_IPs", "Shotbow_Emails", "SirenCraft_IPs", "SilexPVP_IPs", "SpainPVP_Emails", "SpellPVP_IPs", "StellarPVP_IPs", "StormyMC_IPs", "StrideZone_IPs", "StrivePVP_IPs", "TeamSpeak_DB_Compilation", "TheBigDigMC_Emails", "Towelliee_Emails", "Trexic_IPs", "Triad_IPs", "ValidHCF_IPs", "VanityMC_IPs", "VardenGalaxy_IPs", "VeltPVP_Emails", "VeltPVP_IPs", "VenomPVP_IPs", "VerilHQ_IPs", "VerixPVP_Factions_IPs", "VerixPVP_Skyblock_IPs", "ViperMC_IPs", "VitalityHCF_IPs", "Vysteria_IPs", "WaffleMinecraft_Emails", "Warfine_IPs", "WaveHCF_IPs", "WenjaHCF_IPs", "WinterMC_IPs", "Yahoo_DB", "ZetHC_IPs", "ZetMC_IPs", "Zolus_IPs", "Zolux_IPs", "iPvP_IPs", "nUg_IPs", "ythc_IPs");

    $tableelements = count($tables);
    $tableiterator = 0;
    $resultiterator= 0;

    // HANDLE API KEY //
    if(isset($_GET['key'])) {
        if(!in_array($_GET['key'], $key)) {
            die("ERR: INVALID KEY");
        }
    } elseif(!isset($_GET['key'])) {
        die(/*"ERR: KEY UNDEFINED"*/);
    }

    // HANDLE GET FIELDS //
    if(!isset($_GET['method'], $_GET['search'])) {
        die("ERR: METHOD/SEARCH UNDEFINED");
    }

    // HANDLE SQL DATABASE CONNECTION
    if(!$db_conn){
        die();
    }

    if($_GET['search'] == "") {
        die("ERR: SEARCH CANNOT BE BLANK");
    }

    $search = $_GET['search'];

    if(in_array($_GET['key'], $key)) {
        if($_GET['method'] == "username") {
            echo "{\"results\":{";
            foreach($tables as $databutt) {
                $stmt = $db_conn->prepare("SELECT * FROM {$databutt} WHERE username = ?");
                if ( $stmt == False ) {
                     continue;
                }
                $stmt->bind_param('s', $search);
                $stmt->execute();
                $results = $stmt->get_result();

                if($results->num_rows === 0) {
                    ++$tableiterator;
                } else {
                    while($data = $results->fetch_assoc()) {
                        if($databutt == "MapleCraft_Private" || $databutt == "MCRivals_IPs" || $databutt == "OlympusMC_IPs" || $databutt == "SirenCraft_IPs") {
                            ++$resultiterator;
                            echo '"'.$resultiterator.'":{';
                            echo "\"database\":\"".str_replace("_", " ", $databutt)."\",";
                        } else {
                            ++$resultiterator;
                            echo '"'.$resultiterator.'":{';
                            echo "\"database\":\"".str_replace("_", " ", $databutt)."\",";
                        }
                        if(array_key_exists("username", $data)) {
                            echo "\"username\":\"{$data['username']}\",";
                        }
                        if(array_key_exists("uuid", $data)) {
                            echo "\"uuid\":\"{$data['uuid']}\",";
                        }
                        if(array_key_exists("email", $data)) {
                            if(strcmp(array_key_last($data), "email") !== 0) {
                                echo "\"email\":\"{$data['email']}\",";
                            } else {
                                echo "\"email\":\"{$data['email']}\"";
                            }
                        }
                        if(array_key_exists("ip_address", $data)) {
                            if(strcmp(array_key_last($data), "ip_address") !== 0) {
                                echo "\"ip\":\"{$data['ip_address']}\",";
                            } else {
                                echo "\"ip\":\"{$data['ip_address']}\"";
                            }
                        }
                        if(array_key_exists("password", $data)) {
                            if(strcmp(array_key_last($data), "password") !== 0) {
                                echo "\"password\":\"{$data['password']}\",";
                            } else {
                                echo "\"password\":\"{$data['password']}\"";
                            }
                        }
                        echo "},";
                    }
//                echo "\"buffer\":\"\"}";
                }
            }
            $stmt->close();
        } elseif($_GET['method'] == 'uuid') {
            echo "{\"results\":{";
            foreach($tables as $databutt) {
                $stmt = $db_conn->prepare("SELECT * FROM {$databutt} WHERE uuid = ?");
                if ( $stmt == False ) {
                     continue;
                }
                $stmt->bind_param('s', $search);
                $stmt->execute();
                $results = $stmt->get_result();

                if($results->num_rows === 0) {
                    ++$tableiterator;
                } else {
                    while($data = $results->fetch_assoc()) {
                        if($databutt == "MapleCraft_Private" || $databutt == "MCRivals_IPs" || $databutt == "OlympusMC_IPs" || $databutt == "SirenCraft_IPs") {
                            ++$resultiterator;
                            echo '"'.$resultiterator.'":{';
                            echo "\"database\":\"".str_replace("_", " ", $databutt)."\",";
                        } else {
                            ++$resultiterator;
                            echo '"'.$resultiterator.'":{';
                            echo "\"database\":\"".str_replace("_", " ", $databutt)."\",";
                        }
                        if(array_key_exists("username", $data)) {
                            echo "\"username\":\"{$data['username']}\",";
                        }
                        if(array_key_exists("uuid", $data)) {
                            echo "\"uuid\":\"{$data['uuid']}\",";
                        }
                        if(array_key_exists("email", $data)) {
                            if(strcmp(array_key_last($data), "email") !== 0) {
                                echo "\"email\":\"{$data['email']}\",";
                            } else {
                                echo "\"email\":\"{$data['email']}\"";
                            }
                        }
                        if(array_key_exists("email", $data)) {
                            if(strcmp(array_key_last($data), "email") !== 0) {
                                echo "\"email\":\"{$data['email']}\",";
                            } else {
                                echo "\"email\":\"{$data['email']}\"";
                            }
                        }
                        if(array_key_exists("ip_address", $data)) {
                            if(strcmp(array_key_last($data), "ip_address") !== 0) {
                                echo "\"ip\":\"{$data['ip_address']}\",";
                            } else {
                                echo "\"ip\":\"{$data['ip_address']}\"";
                            }
                        }
                        if(array_key_exists("password", $data)) {
                            if(strcmp(array_key_last($data), "password") !== 0) {
                                echo "\"password\":\"{$data['password']}\",";
                            } else {
                                echo "\"password\":\"{$data['password']}\"";
                            }
                        }
                        echo "},";
                    }
                }
            }
        $stmt->close();
        } elseif($_GET['method'] == 'ip') {
            echo "{\"results\":{";
            foreach($tables as $databutt) {
                $stmt = $db_conn->prepare("SELECT * FROM {$databutt} WHERE ip_address = ?");
                if ( $stmt == False ) {
                     continue;
                }
                $stmt->bind_param('s', $search);
                $stmt->execute();
                $results = $stmt->get_result();

                if($results->num_rows === 0) {
                    ++$tableiterator;
                } else {
                    while($data = $results->fetch_assoc()) {
                        if($databutt == "MapleCraft_Private" || $databutt == "MCRivals_IPs" || $databutt == "OlympusMC_IPs" || $databutt == "SirenCraft_IPs") {
                            ++$resultiterator;
                            echo '"'.$resultiterator.'":{';
                            echo "\"database\":\"".str_replace("_", " ", $databutt)."\",";
                        } else {
                            ++$resultiterator;
                            echo '"'.$resultiterator.'":{';
                            echo "\"database\":\"".str_replace("_", " ", $databutt)."\",";
                        }
                        if(array_key_exists("username", $data)) {
                            echo "\"username\":\"{$data['username']}\",";
                        }
                        if(array_key_exists("uuid", $data)) {
                            echo "\"uuid\":\"{$data['uuid']}\",";
                        }
                        if(array_key_exists("email", $data)) {
                            if(strcmp(array_key_last($data), "email") !== 0) {
                                echo "\"email\":\"{$data['email']}\",";
                            } else {
                                echo "\"email\":\"{$data['email']}\"";
                            }
                        }
                        if(array_key_exists("ip_address", $data)) {
                            if(strcmp(array_key_last($data), "ip_address") !== 0) {
                                echo "\"ip\":\"{$data['ip_address']}\",";
                            } else {
                                echo "\"ip\":\"{$data['ip_address']}\"";
                            }
                        }
                        if(array_key_exists("password", $data)) {
                            if(strcmp(array_key_last($data), "password") !== 0) {
                                echo "\"password\":\"{$data['password']}\",";
                            } else {
                                echo "\"password\":\"{$data['password']}\"";
                            }
                        }
                        echo "},";
                    }

                }
            }
//            echo "\"buffer\":\"\"}";
            $stmt->close();
        } else {
            die("ERR: METHOD MUST BE \"username\", \"uuid\", or \"ip\"");
        }
        echo "\"buffer\":\"\"}}";
    }
?>
