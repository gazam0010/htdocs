<?php
echo '<table width="100%">';
                        echo '<tr>';
                        echo '<td align="left">';
                        echo '<form method="post" action="">Current Session Status: ';
                        echo '<strong>';
                        if (isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'])) {
                            if ($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile'] == $mobile) {
                                echo '<font color="green">Active </font>';
                                echo '<input class="w3-button w3-red w3-small" type="submit" value="End" name="close_user_session">';
                            }
                        } else {
                            echo '<font color="black">Not Active</font>';
                        }
                        echo '</strong></form>';
                        echo '</td>';
                        echo '<td align="right">';
                        echo '<form method="post" action=""><input type="hidden" name="username" value="' . $mobile . '">
                                 <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">
                                 <input class="w3-button w3-green" type="submit" value="Login as ' . $fname . '" name="head_mode"></form>';
                        echo '</td>';
                        echo '</tr>';

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
                            echo '<input type="submit" class="w3-button w3-blue" name="enable_user" value="Enable Account">';
                        }
                        if ($status == 'Active') {
                            echo '<input type="submit" class="w3-button w3-blue" name="disable_user" value="Disable Account">';
                        }
                        if ($status == 'Disabled' || $status == 'Active') {
                            echo '&nbsp;<input type="submit" class="w3-button w3-red" name="delete_user" value="Delete Account">';
                        }
                        if ($status == 'Deleted') {
                        echo '<input type="submit" class="w3-button w3-blue" name="enable_user" value="Enable Account">';
                        }
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td colspan="2">';
                        echo '<hr>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo '<form method="post" action="">
                                 <label>Name: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" name="fname" type="text" value="' . $fname . '" placeholder="Enter Name"/>';
                        echo '</td>';
                        echo '<td>';
                        echo '<label>Email: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" type="email" value="' . $email . '" name="email" placeholder="Enter Email ID"/>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo '<label>Mobile: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" type="text" value="' . $mobile . '" name="mobile" placeholder="Enter Mobile/Username"/>';
                        echo '</td>';
                        echo '<td>';
                        echo '<label>Wallet Balance: </label>
                                 <input class="w3-input w3-border" style="width: 90%;" type="text" value="' . $balance . '" name="balance" placeholder="Enter Mobile/Username"/>';
                        echo '</td>';
                        echo '<input type="hidden" name="id" value="' . $id . '"/>
                                 <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                        echo '</tr>';
                        echo '</tr>';
                        echo '<td>';
                        echo '<br><input class="w3-button w3-green w3-large" name="update_user_details" type="submit" value="Save" class="btn-success"/>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo '<p align="left"><button type="button" onclick="showRaiseRequestAdm()" class="w3-btn w3-small w3-blue">New Ticket</button></p>';
                        echo '</td>';
                        echo '<td>';
                        echo '<div id="raiseRequestAdm" style="display: none;">';
                        echo '<form method="post" action="">
                        <input type="text" style="width: 80%;" name="request_msg" cols="2" rows="2" placeholder="Write request message">';
                        echo '<input type="hidden" name="cid" value="' . $id . '">
                        <input type="hidden" name="eid" value="' . $eid . '">
                        <input type="hidden" name="return" value="' . $_SERVER['REQUEST_URI'] . '">';
                        echo '<input type="submit" name="raise_request" style="background-color: orange" value="Submit" >';
                        echo '</form></div>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        if (count($tkt_status) > 0 && count($tkt_id) > 0) {
                            echo '<th align="center">Tickets</th>';
                            echo '<th align="center">Status</th>';
                            }
                        echo '</tr>';
                        echo '<tr>';
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
                            echo $tkt_statu .'<br>';
                            }
                            echo '</td>';
                        }
                        echo '</tr>';
                        echo '</table>';
                        ?>