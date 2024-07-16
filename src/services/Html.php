<?php

class Html
{
    function CreateTableHtml($dataTable)
    {
        $html = '<table class="table table-striped table-bordered border-primary">
            <thead>
            <tr>';
        foreach ($dataTable as $profilAdmin) {
            foreach ($profilAdmin as $key => $value) {
                $html .= '<th scope="col">'.$key.'</th>';
            }
            break;
        }
        $html .= '</tr></thead>
            <tbody>';
        foreach ($dataTable as $profilAdmin) {
            $html .= '<tr>';
            foreach ($profilAdmin as $key => $value) {
                $html .= '<td> ' . $value . ' </td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>
        </table>';

        return $html;
    }
}