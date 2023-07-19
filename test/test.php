<div class="container">
      <ul id="ac">
         <li class="menu1">
            <a href="#">Menu1</a>
            <ul class="menu2">
               <li><a href="#">Sub-Menu1</a></li>
               <li><a href="#">Sub-Menu2</a></li>
               <li><a href="#">Sub-Menu3</a></li>
            </ul>
         </li>
         <li class="menu1">
            <a href="#">Menu2</a>
            <ul class="menu2">
               <li><a href="#">Sub-Menu1</a></li>
               <li><a href="#">Sub-Menu2</a></li>
               <li><a href="#">Sub-Menu3</a></li>
            </ul>
         </li>
         <li class="menu1">
            <a href="#">Menu3</a>
            <ul class="menu2">
               <li><a href="#">Sub-Menu1</a></li>
               <li><a href="#">Sub-Menu2</a></li>
               <li><a href="#">Sub-Menu3</a></li>
            </ul>
         </li>
         <li class="menu1">
            <a href="#">Menu4</a>
            <ul class="menu2">
               <li><a href="#">Sub-Menu1</a></li>
               <li><a href="#">Sub-Menu2</a></li>
               <li><a href="#">Sub-Menu3</a></li>
            </ul>
         </li>
      </ul>
   </div>
   
   
   
   <style>
    ol,ul,li{list-style: none;}
      *{padding:0; margin:0;}
      a{text-decoration: none;}
      .container{
         display:flex;
         justify-content: center;
         align-items: center;
         height:100vh;
      }
      #ac{
         width: 300px;
      }
      #ac li a{
         display:block;
         width: 100%;
         text-align: center;
         height:50px;
         line-height: 50px;
         border:1px solid #eee;
      }
      #ac .menu1 a{
         background-color: #000;
         color:#fff;
      }
      #ac .menu1.on{
         background-color:red;
      }
      #ac .menu2{
         display:none;
      }
      #ac .menu2 a{
         background-color:#ccc;
         color:blue;
      }
      #ac .menu2 a:hover{
         background-color:rgba(0, 0, 0, 0.500);
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    
    <script>
      $('.menu1').click(function(){
         $('.menu2').slideUp();
         if ($(this).children('.menu2').is(':hidden')){
            $(this).children('.menu2').slideDown();
         } else{
            $(this).children('.menu2').slideUp();
         }
      });
      </script>