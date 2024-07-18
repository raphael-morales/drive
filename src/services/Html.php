<?php

class Html
{
    /**
     * @throws Exception
     */
    function CreateTableHtml($dataTable, $dataRoles, $bool=false)
    {
        if (!empty($dataTable)){
            $html = '<table class="table-bordered">
            <thead>
            <tr>';
            foreach ($dataTable as $profil) {
                foreach ($profil as $key => $value) {
                    $html .= '<th scope="col">'.$key.'</th>';
                }
                break;
            }
            $html .= '</tr></thead>
            <tbody>';
            foreach ($dataTable as $profil) {
                $html .= '<form action="" method="post"><tr>';
                foreach ($profil as $key => $value) {
                    $html .= '<th xmlns="http://www.w3.org/1999/html">';
                                if ($key == "Role"){
                                    $html .= '<select name="' . $key . '">';
                                    foreach ($dataRoles as $roles => $role){
                                        if ($role["Role"]===$value){
                                            $html .= '<option selected value="' . $role["Role"] . '">' . $role["Role"] . '</option>';
                                        }else{
                                            $html .= '<option value="' . $role["Role"] . '">' . $role["Role"] . '</option>';
                                        }
                                    }
                                    $html .= '</select>';
                                }else{
                                    switch ($key){
                                        case "Inscription":
                                        case "Anniversaire":
                                            $eventDate = new DateTime($value);
                                            $html .= '<input disabled style="width: 100%" name="' . $key . '" value="' . $eventDate->format('d-m-Y') . '">';
                                            break;
                                        case "date":
                                            $eventDate = new DateTime($value);
                                            $html .= '<input disabled style="width: 100%" name="' . $key . '" value="Le ' . $eventDate->format('d-m-Y à H:i:s') . '">';
                                            break;
                                        default:
                                            $html .= '<input disabled style="width: 100%" name="' . $key . '" value="' . $value . '">';
                                            break;
                                    }
                                }
                    $html .=   '</th>';
                }

                if (!$bool){
                    $html .= '<th scope="col"><button class="btn btn-primary m-1" type="submit">Enregistrer</button></th>';
                }else{
                    $html .= '<th scope="col"><button class="btn btn-primary m-1" type="submit">Traiter</button></th>';
                }
                $html .= '</tr></form>';
            }
            $html .= '</tbody>
        </table>';

            return $html;
        }else{
           return false;
        }
    }
}