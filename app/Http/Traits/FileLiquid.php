<?php

namespace App\Http\Traits;

trait FileLiquid{

    public function fileLiquid($data,$popup){
       $css = '<style>
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: absolute;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            cursor: pointer;
        }

        
        }
       </style>';
            $html ='<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';
            $html .= '<div  class="popup" >';

            $html .= ' <div class="popup-content " style="background-color:'.$popup["backgroundColor"].'">';
            $html .= '<h1 id="heading" style="color: '.$popup["textColor"]. ';max-width : 400px" class="heading display-4">'. $popup["heading"].'</h1>';
            $html .= '<span class="close" id="closePopup">&times;</span>';
            $html .= '<p class="description h4 mt-5 mb-4" style="color:'.$popup["textColor"].';max-width : 400px">'. $popup["description"] .'</p>';
            $html .= '<div class="popup-img">';
            $html .= '<img src="'.$popup['imageURL'].'" alt="" class="img-popup" style="width:380px">';
            $html .= '</div>';
            $html .= '<div>';
            $html .= '<button class="btn btn-success mt-4 p-2 btn-shop">Shop now</button>';
            $html .= '</div>';
            $html .= '</div>';
       $html .= '</div>';
    //    $html .= '<img src="'. '{{asset("images/'. $data->img .'")}}'.'" alt="" class="img-popup" style="width:380px">';


       $script = "
       <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.querySelector('.popup-content').style.display = 'block';
              }, '2000');
            
        });

        document.querySelector('.btn-shop').addEventListener('click',function(){
            document.querySelector('.popup').style.display = 'none';

        });

        document.getElementById('closePopup').addEventListener('click', function() {
            document.querySelector('.popup').style.display = 'none';
        });

        // Đóng popup khi người dùng nhấn bất kỳ nơi nào bên ngoài popup

        window.addEventListener('click', function(event) {
            var popup = document.querySelector('.popup');
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        });
        </script>
       ";
       return $css.$html.$script;
    }




}