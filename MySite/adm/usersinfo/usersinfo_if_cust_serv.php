<?php
echo '<table width="100%">';
                        echo '<tr>';
                        if ($status == 'Disabled') {
                            echo '<td>Account Status: <font color="orange"><strong>' . $status . '</strong></font></td>';
                        } else if ($status == 'Deleted') {
                            echo '<td>Account Status: <font color="red"><strong>' . $status . '</strong></font></td>';
                        } else {
                            echo '<td>Account Status: <font color="green"><strong>' . $status . '</strong></font></td>';
                        }
                        echo '<td align="right">';
                        echo '<form method="post" action="">
                                 <input type="hidden" name="username" value="' . $mobile . '">
                                 <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                        if ($status == 'Disabled') {
                            echo '<input type="submit" class="w3-button w3-blue" onclick="return confirmEnable()" name="enable_user" value="Enable Account">';
                        } 
                        if ($status == 'Active') {
                            echo '<input type="submit" class="w3-button w3-blue" onclick="return confirmDisable();" name="disable_user" value="Disable Account">';
                        }
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo '<hr>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo 'Full Name: <strong>' . $fname . '</strong>';
                        echo '</td>';
                        if (count($tkt_status) > 0 && count($tkt_id) > 0) {
                        echo '<th align="center">Tickets</th>';
                        echo '<th align="center">Status</th>';
                        }
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo 'Email ID: <strong>' . $email . '</strong>';
                        echo '</td>';
                        if (count($tkt_status) > 0 && count($tkt_id) > 0) {
                            echo '<td rowspan="3" align="center">';
                            foreach ($tkt_id as $tkt_i) {
                                echo '<a style="text-decoration: none; color: blue;" href="#" onclick=openNewWindow("../ticket_status.php?ticket_id=' . $tkt_i . '")>' . $tkt_i . '</a><br>';
                            }
                            echo '</td>';
                            echo '<td rowspan="3" align="center">';

                            foreach ($tkt_status as $tkt_statu) {
                            if ($tkt_statu == "Open") {
                                $tkt_statu = '<font color="green">'.$tkt_statu.'</font>';
                            } else if($tkt_statu == "Processing") {
                                $tkt_statu = '<font color="orange">'.$tkt_statu.'</font>';
                            } else if($tkt_statu == "Closed") {
                                $tkt_statu = '<font color="red">'.$tkt_statu.'</font>';
                            }
                                echo $tkt_statu.'<br>';
                            }
                            echo '</td>';
                        }
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo 'Mobile: <strong>' . $mobile . '</strong>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo 'Wallet Balance: <strong>' . $balance . '</strong>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td colspan="2" align="right">';
                        echo '<br><button class="w3-button w3-green" type="button" onclick="showRaiseRequest()">Raise Request</button>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '<div id="raiseRequest" style="display: none;">';
                        echo '<form method="post" action=""><textarea type="text" name="request_msg" class="w3-input" cols="2" rows="2" placeholder="Write request message"></textarea><br>';
                        echo '<input type="hidden" name="cid" value="' . $id . '"><input type="hidden" name="eid" value="' . $eid . '"><input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                        echo '<input type="submit" name="raise_request" value="Submit" class="w3-button w3-small w3-right w3-red"><br>';
                        echo '</form></div>';
                        ?>