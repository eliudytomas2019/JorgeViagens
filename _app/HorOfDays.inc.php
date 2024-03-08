<?php
        $Meses = ["", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

        if(date('m') == $key['mes']&& date('Y') == $key['ano']):
            $dias = date('d') - $key['dia'];
            if($dias == 0):
                $hor = explode(":", $key['hora']);
                $horas = date('H') - $hor[0];
                $minutos = date('i') - $hor[1];
                if($horas <= 0):
                    echo "há ".$minutos." minutos";
                elseif(date('H') - $hor[1] == 1 && $minutos <= 59):
                    $start = new DateTime($key['hora']);
                    $end = new DateTime(date('H:i'));
                    $difference = $end->diff($start);
                    $minutes = $difference->i;
                    echo "há ".abs($minutes)." minutos";
                elseif($horas == 1):
                    echo "há ".$horas." hora";
                else:
                    echo "há ".$horas." horas";
                endif;
            elseif($dias == 1):
                echo "ontem às ".$key['hora'];
            else:
                echo "há ".abs($dias)." dias às ".$key['hora'];
            endif;
        else:
            $xMes = (int) $key['mes'];
            echo $key['dia']." de ".$Meses[$xMes]." de ".$key['ano'];?> às <?= $key['hora'];
        endif;
    ?>