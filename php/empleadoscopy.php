<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {

        header('location: ../index.php');
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Empleados | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/appweb.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <style type="text/css">

    </style>
    <script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
</head>

<body>

    <header class="encabezado">
        <h1 class="tituloheader">ADMINISTRADOR PASTELERÍA TRÉBOL</h1>
    </header>
    <nav class="navegacion">
        <li><a class='icon-logout' href='logout' title='Cerrar Sesión'></a></li>
        <li class="#"><a class='icon-user' href='userapp' title='Usuario'></a></li>
        <p class="textbienv"><?php echo "Bienvenido, " . $_SESSION["usuario"]?></p>
    </nav>


    <div class="contenedor1">

        <?php
        require_once('../partials/sidenavapp.php')
        ?>

        <section class="contenido">
            <div>
                
            </div>
            <div class="header">
                <h2 class="title">Lista de Empleados</h2>
            </div>
            <?php
                    
                    require_once("config.php");
                    
                    $sql = "SELECT * FROM empleado";
                    if($result = mysqli_query($link, $sql)) {
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='tabla'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Apellidos</th>";
                                        echo "<th>Teléfono</th>";
                                        echo "<th>Correo electrónico</th>";
                                        echo "<th>Sucursal</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_empleado'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['apellidos'] . "</td>";
                                        echo "<td>" . $row['telefono'] . "</td>";
                                        echo "<td>" . $row['correo_electronico'] . "</td>";
                                        echo "<td>" . $row['sucursal'] . "</td>";
                                        echo "<td class='filaopc'>";
                                            echo "<a class='ver' href='ver_empleado?id=". $row['id_empleado'] ."' title='Ver Información'><span class='icon-eye'></span></a>";
                                            echo "<a class='editar' href='editar_empleado?id=". $row['id_empleado'] ."' title='Actualizar'><span class='icon-pencil'></span></a>";
                                            echo "<a class='borrar' href='eliminar_empleado?id=". $row['id_empleado'] ."' title='Borrar'><span class='icon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='texto'>Los registros de empleados se encuentran vacíos</p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }


                    mysqli_close($link);
                    ?>
            <a href="crear_empleado" class="btn">Añadir Empleado</a>

        </section>

        <footer class="footerc2">2020 | Pastelería Trébol</footer>

        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur libero provident officia, obcaecati quis delectus. Voluptate, magnam, molestiae similique sit reprehenderit officiis voluptates nam, soluta iusto reiciendis laborum eligendi eos!
            Quia molestiae molestias non perferendis consequatur repellat consequuntur, officia placeat, error ex minus autem sapiente ipsa. Quaerat temporibus ipsa at quas maxime rerum est? Nam itaque tenetur quia corporis ad?
            Veritatis ipsa repudiandae veniam ab aliquam sequi, ullam, omnis animi fuga, alias pariatur! Ab magni rerum, eligendi quaerat cum cupiditate totam impedit voluptates, ea ratione soluta qui necessitatibus dolorem officia.
            Fugiat, vero libero perferendis quaerat quisquam corrupti similique incidunt vel, repellendus eaque voluptatum officiis perspiciatis asperiores quasi recusandae consequatur consequuntur ipsum beatae officia iste facere pariatur odio eligendi? Odio, quos!
            Qui aspernatur quaerat, debitis, atque delectus provident cumque et dolorum dolores, est cupiditate totam beatae natus illo. Dolore officia, consectetur quos quas error cumque, harum, facere id voluptatum est voluptates.
            Optio odit, eligendi nisi inventore officia impedit enim, hic minus recusandae atque, at saepe ipsa! Necessitatibus nobis, quisquam autem ea velit repudiandae iure saepe sapiente mollitia possimus ipsa. Voluptas, voluptatibus.
            Vel facilis, in perspiciatis quod dolorum iusto fuga! Provident accusamus perspiciatis nisi sint error ipsa, sed eius tenetur adipisci doloribus est quasi laboriosam possimus magnam tempore recusandae similique suscipit beatae!
            Voluptatum dolore neque suscipit at enim placeat consequatur debitis amet. Architecto iste voluptatem dignissimos libero saepe, minus neque molestiae officiis ipsa provident dolorum natus officia praesentium reiciendis, fuga aspernatur necessitatibus!
            Voluptatibus ut similique, iure nisi eaque expedita, itaque nam fuga, nobis numquam sapiente enim amet iusto minus velit? Minus sequi enim quibusdam numquam sit dolor eveniet doloribus ab eaque? Possimus.
            Itaque asperiores aperiam quam voluptatibus doloribus temporibus inventore, suscipit ut mollitia, officia culpa quisquam dolorum. Vero perferendis non illo facilis similique culpa quibusdam eligendi, vel cupiditate, ipsam unde reprehenderit rerum!
            Repudiandae dolorem minima voluptates beatae veritatis maxime nemo et a iusto? Impedit fugit, odit, excepturi eius officia, placeat ad voluptatibus ab nobis nam hic exercitationem. Quas quis facilis nam ducimus?
            Consectetur, magni eius! Dolorem quam commodi sapiente sunt esse soluta, et ipsum! Corrupti esse ipsa dolore facere! Obcaecati nisi temporibus dolores nobis, consequuntur explicabo ex quis velit, quaerat praesentium earum!
            Atque magnam illum recusandae quas impedit architecto dolore est delectus reiciendis ducimus ipsam doloribus maxime, minus blanditiis in nulla nobis molestiae placeat assumenda beatae obcaecati. Magnam unde nostrum alias adipisci!
            Facilis, molestiae culpa nemo reiciendis fuga expedita, ipsa ab tenetur sint debitis necessitatibus libero delectus quisquam quaerat ratione est quibusdam atque quas quod distinctio nulla voluptatem. Pariatur veritatis magni assumenda.
            Voluptatum velit ullam, cumque nobis eum iste. Atque voluptate eum perferendis optio? Facere quia delectus dolorem, asperiores aperiam unde dolores voluptates impedit sapiente, esse animi laudantium, sint ipsam reiciendis odit.
            Itaque repellat blanditiis voluptatum repudiandae delectus, libero nam tenetur, cumque voluptates dolorem asperiores ea, fugit harum animi ducimus corrupti consectetur vero. Iure odit nisi repellat, deserunt doloribus atque dolore amet?
            Laudantium ipsum vero provident voluptates rem laboriosam accusantium delectus possimus cumque accusamus, nisi quam vel pariatur. Error, eum maiores cupiditate sunt odio ab! Omnis laudantium voluptas fugit delectus amet suscipit.
            Quibusdam minima fugit quo facere recusandae corporis hic ut error, in amet maxime doloribus eius, quasi nam aliquid doloremque! Inventore omnis iusto dolore necessitatibus sint natus voluptatibus nemo labore! Tenetur.
            Odit ab quaerat tenetur totam asperiores soluta nobis architecto omnis delectus. Labore eos excepturi quidem quas saepe voluptate, nostrum autem, dolore neque tempore perspiciatis. Odio facilis quia iure ducimus. Odio.
            Nisi ab culpa voluptas voluptate. Veritatis dolore earum, sed adipisci distinctio corporis veniam, autem a nemo recusandae sunt odit reprehenderit iste facilis, fuga tenetur labore quasi? Necessitatibus obcaecati minus cum?
            Blanditiis suscipit ex repellendus laudantium totam minus odit repudiandae quis, voluptatum laboriosam expedita sed cum deserunt provident similique exercitationem. Quo reprehenderit, temporibus inventore blanditiis nemo ullam repellat. Eum, cupiditate velit?
            Aliquid ex quidem laudantium accusamus voluptas dolorum molestias, culpa ratione, vitae, at ipsum. Perferendis illo aliquid libero est ducimus dignissimos, quia maiores nostrum tempora officia cupiditate iusto suscipit aspernatur. Minima!
            Reprehenderit maiores, et enim, quos obcaecati illo, delectus sequi dolorem accusamus quis autem hic nostrum voluptatibus repellat beatae architecto vero consectetur alias animi voluptate nihil cum sunt neque! Tenetur, provident.
            Quaerat deserunt sunt earum, ipsa porro repellendus quae incidunt iure dolorem! Itaque quaerat numquam placeat tenetur magni cumque eum minus pariatur accusamus unde consectetur ab, sint quod vero! Atque, ipsa?
            Laboriosam cumque mollitia quo odio iste numquam architecto nesciunt suscipit veniam, commodi exercitationem minima adipisci est beatae repellendus nihil inventore enim dignissimos qui cum ullam veritatis expedita? Excepturi, minus saepe.
            Assumenda eveniet laudantium libero repudiandae odit facere, eum nesciunt et neque doloremque ut eos totam perferendis distinctio quis quas. Voluptatibus quisquam corporis temporibus sed ab, saepe sunt laborum id autem!
            Vero sed at sunt quas eligendi. Sit atque, eveniet tenetur blanditiis dolorum magnam corporis esse molestiae debitis veritatis culpa deserunt eaque! Assumenda sequi porro necessitatibus, fugit nulla aliquid praesentium corrupti?
            Nostrum excepturi alias sed laudantium vero cumque ipsa mollitia ut quam quia obcaecati reprehenderit animi commodi pariatur maiores vitae blanditiis, nobis tenetur quisquam perspiciatis! Sequi doloribus est aliquam corrupti quam.
            Dolore obcaecati repudiandae quasi amet, ab aut eos iusto officiis facere corporis est asperiores cum earum. Dolore voluptate soluta, asperiores labore vel, exercitationem nam dolorem dolor reiciendis culpa, perferendis adipisci?
            Aliquam id porro quo? Cum maiores repellendus possimus! Delectus accusantium commodi aliquam aperiam, eligendi optio sed debitis sapiente, expedita nobis corporis fugit a facere similique molestias adipisci, assumenda numquam illo.
            Voluptas eligendi dignissimos sed dolores? Eveniet consequuntur id officia fuga distinctio deserunt a perspiciatis facere sit ullam alias quibusdam dolore animi repudiandae, cupiditate praesentium pariatur eaque, voluptate culpa delectus enim!
            Fugiat architecto doloremque rerum exercitationem rem, nesciunt distinctio ipsa maiores nostrum officiis, voluptate, pariatur recusandae quam. Repellat exercitationem nisi corporis sequi delectus quasi quos culpa perspiciatis voluptates, provident corrupti tenetur.
            Laudantium harum odio praesentium esse ab fugiat quidem rerum cumque magni sapiente modi assumenda odit accusamus minima magnam nobis doloribus, commodi voluptates autem at eligendi inventore reprehenderit labore blanditiis? Omnis?
            Earum magni sapiente sit voluptatem sequi necessitatibus nemo obcaecati, illo nam ullam cumque ipsa vero possimus perspiciatis. Accusantium officiis, necessitatibus modi provident debitis blanditiis dicta minima, quia corporis dignissimos molestiae.
            Quod blanditiis iste magnam doloremque. Suscipit ut dolores sit delectus laudantium ullam sequi vitae modi nulla? Quo consequuntur nesciunt assumenda dolore quos beatae debitis quas, in ut, porro sapiente harum?
            Perferendis sequi explicabo esse voluptate, ipsa, minus, natus corrupti quas temporibus repellendus quidem officia deleniti veniam voluptatum obcaecati quos cumque vero ipsum rem! Quia tempora corporis voluptatum iusto quae voluptatem?
            Ad neque, et odit facere omnis inventore architecto vitae nobis laboriosam praesentium deserunt placeat quasi autem, sit delectus aliquid quaerat vero. Maiores ex veniam doloribus recusandae eligendi iusto explicabo possimus.
            Distinctio nihil deserunt soluta nemo hic fugit repellendus magni natus ipsam. Maxime error fuga dignissimos esse cum nemo rerum nihil et, alias nesciunt. Consequatur repudiandae odio sequi labore aspernatur illo.
            Facilis dicta assumenda ducimus vel vitae iure nesciunt voluptate ipsum inventore officia eius unde perferendis quos porro adipisci, ipsa ea ab? Ad in vitae quo delectus dolor debitis accusantium quaerat!
            Tempora dicta in harum quo debitis? Provident odio alias eveniet. At nesciunt officia dolore, nulla adipisci ullam laborum voluptatum fugiat perferendis maxime quis omnis possimus, alias doloremque unde facere illo!
            Fuga libero repellendus soluta quod omnis sint saepe itaque eius vel quisquam fugit, asperiores eveniet modi excepturi explicabo similique ipsa facilis assumenda voluptatibus, exercitationem iure provident, a facere. Alias, at.
            Vero autem voluptas natus placeat nam aut reiciendis earum quibusdam et optio, neque provident tempora tempore nulla eum repellendus perferendis illo quo voluptate rem in. Eveniet autem quaerat illum aliquid.
            Quod officiis voluptate cupiditate magnam atque nemo neque voluptatibus ad reiciendis libero, nihil eius sed dolorem quas quo ipsam. Debitis unde, voluptas dolore quia temporibus dolorem rerum. Doloribus, rem impedit?
            Ea delectus veniam aspernatur, praesentium quas libero totam reprehenderit at architecto suscipit doloremque ex similique voluptates assumenda magni quam debitis velit! Ad est obcaecati saepe hic nisi veniam dicta sint.
            Corrupti fugiat reprehenderit dolore quam quibusdam, commodi nam perspiciatis natus dolorum dicta quisquam nisi iste omnis eaque cum minus, quod, soluta enim provident doloremque iure. Ipsum unde deleniti quas accusamus!
            Quia veniam laborum laboriosam quam eos consectetur! Corrupti voluptatum illo libero mollitia, aliquam in ipsum excepturi voluptates modi voluptate sint adipisci perspiciatis, laudantium recusandae id dignissimos sequi, repellat error. Atque.
            Vitae mollitia earum dolores delectus, ad quisquam, a assumenda labore facilis perferendis libero aut ullam? Qui vitae neque tempora unde numquam atque odit laborum tempore iste autem cum, esse illum?
            At ab doloribus dignissimos soluta suscipit accusamus amet, facere nam, sint in cupiditate. Quae iusto alias laboriosam deleniti amet ipsa nostrum atque cupiditate itaque, explicabo exercitationem ratione a, cum aut.
            Animi impedit fuga ea? Accusamus quia placeat id, eaque doloremque dolor blanditiis facere repellendus sit quis asperiores voluptatum exercitationem nisi autem. Optio totam incidunt ea hic sit, alias quaerat maiores?
            Perferendis non velit hic error quisquam quod facilis excepturi eos quis nobis minima libero saepe ut inventore quas doloremque possimus cum, neque odit, similique fugiat! Qui earum perferendis nesciunt corrupti.
            Recusandae beatae excepturi, repellat quod facere eveniet aliquam eaque consequuntur commodi adipisci eum consectetur, minus autem. Eaque, dolorem neque ipsa facere cupiditate in ad asperiores voluptate temporibus et quam voluptatibus?
            Molestias, vel. Commodi hic perspiciatis ipsum, dolorum laborum sed. Ipsum assumenda ducimus cum odio repellendus doloribus obcaecati eligendi esse libero? Sequi, dignissimos? Deserunt vitae obcaecati voluptates voluptatibus magni quas voluptatum?
            Vero, earum blanditiis veritatis minima ea officia et aperiam eos libero ad, velit nobis corrupti fugiat necessitatibus, sequi voluptates quam praesentium perspiciatis? Deserunt consequatur magni laudantium, debitis eligendi minima id.
            Inventore reprehenderit provident, rerum ut corporis qui iure nulla! Illo quaerat facilis et, minima autem blanditiis hic dolore, tempore, iure porro atque sunt esse exercitationem? Consequuntur id dicta atque voluptas?
            Accusamus incidunt excepturi nisi corrupti reiciendis, quae magnam corporis qui odit officiis mollitia debitis quisquam impedit dolor laboriosam molestiae veniam eaque! Perspiciatis atque minus, rem ut quisquam dolor molestiae nobis.
            Esse cumque, possimus perspiciatis eius tenetur distinctio iste unde ut quo id velit dolores explicabo ratione cupiditate obcaecati quas eligendi facilis deleniti corrupti in? Obcaecati cum cupiditate atque reprehenderit nulla?
            Commodi non doloribus iure a, et fugit, magni veritatis ipsa sed, accusantium minima dolorum? Aperiam iure recusandae eum? Laboriosam nobis labore earum quisquam quasi iste impedit autem ab officia quaerat.
            Quas, voluptates. Pariatur voluptatum soluta quis quia, optio iure minima magnam dignissimos laudantium eveniet consequuntur natus eum unde eligendi alias sit vitae atque. Molestiae earum ullam atque quaerat ratione. Voluptates!
            Dignissimos, omnis! Animi repellat vel, explicabo magni molestias ab architecto quis ducimus harum! Suscipit officia provident, ipsum voluptas cupiditate temporibus doloremque rem laboriosam voluptatibus exercitationem tenetur velit quidem odio obcaecati!
            Suscipit, quaerat quo omnis debitis doloremque blanditiis eos deserunt, quas asperiores aut tempora fugit inventore aperiam perspiciatis unde enim nobis nam! Consequuntur incidunt esse aliquid autem? Alias vel qui voluptatem.
            Quod ad obcaecati fugit illo perferendis? Cumque alias laborum possimus veritatis, delectus tempora sequi ex autem, numquam mollitia amet eum sit excepturi incidunt voluptas quidem rerum voluptatem consectetur labore fugiat?
            Reiciendis, nostrum possimus! Neque, expedita fugiat repellendus ipsa ipsam, nihil tempore nostrum illo omnis quam laborum quas odit dolorem laudantium repudiandae autem impedit fuga nulla blanditiis consectetur. Placeat, deserunt iusto.
            Laboriosam reiciendis a odio harum fugiat cumque quidem. Cum repudiandae repellendus at ex iusto earum ab quos nobis eveniet nulla voluptate autem eligendi molestiae reiciendis, nostrum libero rem error ipsam.
            Nihil, quam rem? Totam quidem architecto, laborum, neque molestiae adipisci aspernatur voluptatum doloremque nesciunt labore, ipsam recusandae expedita asperiores dolorum et modi possimus. Soluta delectus voluptatibus quis voluptas molestiae recusandae!
            Totam officia ut, tempore harum aperiam porro nam aliquid! Odit repellendus officiis ipsam, unde pariatur nisi corrupti saepe porro quam quasi delectus sapiente a fugit vero? Qui ipsam ad quos!
            Dicta molestiae quae necessitatibus, dolorem veniam deleniti, numquam in, doloremque alias perferendis quasi dolorum! Nostrum, dolor? Iste voluptas similique necessitatibus dolor quasi distinctio ipsum, dolorum aspernatur sapiente quia possimus rem!
            Quisquam tempora voluptatum, vel dolorem numquam blanditiis repellat corporis alias ex dicta delectus quidem soluta modi rem libero eius similique labore amet, ullam esse fugit neque, reiciendis doloremque! Inventore, obcaecati!
            Laborum qui unde earum distinctio rem aspernatur similique aliquam aut! Ducimus odio quod, nulla obcaecati tempora quibusdam commodi libero laudantium illo, aperiam facilis incidunt eos sint est quo? Facere, commodi!
            Provident possimus reprehenderit fuga qui, amet debitis beatae vel repellendus dignissimos ad alias sed perferendis. Doloribus sed, qui similique sint quis et sunt ducimus nemo inventore cumque suscipit laudantium quos.
            Perferendis reiciendis odio ipsum blanditiis praesentium. Nemo mollitia doloremque atque natus non, explicabo dolores ad enim sed sint praesentium ratione facere quas optio vel itaque tempore similique magnam culpa. Corrupti.
            Eligendi sint dolore asperiores est eum minus. Blanditiis, nostrum perferendis. Natus id dolor debitis illo omnis eaque nisi cumque temporibus beatae enim esse, neque dolorum doloribus ratione architecto rem amet?
            Dolor necessitatibus quae omnis? Nesciunt qui iusto enim eligendi adipisci, saepe quibusdam reprehenderit quae. Dolor eveniet, at ullam iure veniam eligendi dignissimos. Sint, provident eveniet sit corporis similique culpa at?
            Eveniet maxime atque voluptatum cum, voluptatibus hic aliquid mollitia autem dignissimos ab omnis ipsam odit perspiciatis facere veniam vitae ipsa praesentium! Est ipsum sit error voluptates nemo quas, praesentium accusantium!
            Corporis eaque harum, ea praesentium voluptas hic rem consequatur non amet delectus iusto saepe provident fugiat eligendi in, id distinctio sequi adipisci omnis quam! Ex ad nesciunt maxime omnis. Quos!
            Pariatur incidunt, tempore vel hic vitae quisquam voluptatem nesciunt, sed a, repudiandae minus voluptatum! Blanditiis placeat beatae inventore perspiciatis perferendis. Unde quae consequatur iure voluptates alias, minima corrupti! Facere, doloribus!
            Ipsum, facere voluptas? Iste accusantium consectetur, ipsa libero dolores, esse animi itaque corrupti provident, quos autem quidem quam non nesciunt maiores eveniet ipsam ut deleniti! Asperiores dolorum dolor at. Aliquid!
            Laboriosam sed, iste repellat deleniti doloremque quidem perferendis beatae sequi dolore voluptatem quos consequatur aspernatur fuga veniam perspiciatis explicabo quis. Quod officiis, iste voluptas ab culpa nisi necessitatibus. Rem, asperiores.
            Atque totam dicta repudiandae magni odio similique numquam sed quasi consequuntur aliquam at recusandae pariatur molestias incidunt quia saepe a culpa, error fugiat quae modi sapiente asperiores. Magni, in quod.
            Consequatur nihil dicta quibusdam ab suscipit unde voluptates vel! Veniam deserunt ut dolorum at, ducimus esse, et soluta qui sunt doloribus aspernatur dolorem fugiat, quod ipsa omnis accusamus. Inventore, temporibus!
            Accusantium tempore aperiam numquam libero perspiciatis? Ab accusamus nobis amet laudantium quod itaque harum aspernatur omnis? Temporibus, reprehenderit aliquam, nihil ullam facere asperiores commodi quae accusamus tempora fugiat corporis dolores!
            Repellendus aspernatur quisquam, dolore neque perspiciatis dolor repellat sed suscipit nihil illum laborum sit distinctio explicabo dolorum animi id vitae tenetur doloremque reprehenderit. Nobis sunt eligendi atque, fuga officiis distinctio.
            Hic corrupti assumenda tenetur consequuntur debitis quibusdam nam, id expedita voluptas fuga neque sapiente maiores cumque fugit sint aliquid molestiae eum. Recusandae cum eligendi ea! Unde molestias quasi eos ipsum!
            Corporis at eveniet, obcaecati voluptate perferendis eius aliquid voluptates autem necessitatibus harum dolores aperiam libero pariatur consequuntur ipsa sint assumenda dignissimos? Consequatur fugit amet suscipit possimus adipisci, placeat veniam quibusdam?
            Iste, exercitationem veniam nobis corporis nesciunt excepturi, culpa obcaecati dolorum, illo voluptas hic assumenda sint vero repellat neque porro repudiandae. Quasi nesciunt suscipit impedit excepturi dolor aut. Ipsa, illo quod!
            Dolores beatae nihil numquam explicabo perspiciatis corporis, laboriosam nobis similique praesentium voluptates eius laborum assumenda, ratione culpa molestiae. Magnam magni nulla quis! Deleniti corrupti magni tempora veniam blanditiis eos ea.
            Odio, nemo! Neque nostrum ab error reiciendis aperiam est labore quidem, debitis, praesentium alias id accusamus ipsa quisquam suscipit. Corporis ducimus expedita nemo corrupti provident quibusdam ad neque consectetur distinctio!
            Consectetur asperiores facilis dolorum nobis autem libero commodi ea minus cum excepturi! Quas quo eos maxime veniam temporibus laborum tenetur. Voluptas, similique ratione. Voluptates, nesciunt quasi tempore temporibus rerum quae.
            Porro reprehenderit fuga non, iusto ipsum provident ab perspiciatis deserunt pariatur modi magni velit, nobis voluptatem sint consequatur harum quibusdam iure. In, repudiandae tenetur ratione sed quas libero ea vel!
            Ad, obcaecati, est aut, fugiat ullam illum rerum nulla vitae enim asperiores sint ipsum voluptatibus doloremque. Deserunt, quisquam corporis nihil, blanditiis eos fugiat minus mollitia culpa, vitae qui illum molestiae.
            Dolorum magnam assumenda veritatis id, error ad. Id quos vero mollitia iure eius dolorum maiores quasi laboriosam, praesentium eaque nam? Sapiente, iusto. Et accusantium fuga reiciendis. Suscipit fuga minima laboriosam!
            Fuga repudiandae repellat similique itaque! Tempora neque ab eos repudiandae aliquam enim nulla omnis voluptates dolore. Voluptatibus, numquam, libero dicta laudantium eligendi impedit quidem accusamus consequuntur voluptates suscipit cupiditate aperiam?
            Dolor eaque praesentium, eius laudantium facere optio, neque magnam tempore placeat molestias nobis, non explicabo. Similique eaque iusto perspiciatis, autem quas earum laudantium distinctio possimus pariatur deserunt praesentium? Dicta, inventore.
            Saepe ipsa alias recusandae nisi, iusto commodi, fuga perferendis voluptates perspiciatis mollitia cumque beatae. Ut, eos asperiores pariatur assumenda eaque eveniet tenetur aut minus corrupti quod perferendis, non cumque ab.
            Sit quidem tempore quas maxime labore vitae optio ut modi veniam sint unde officiis culpa aspernatur consectetur nesciunt cum provident nam, vel velit asperiores doloremque eaque! Quis earum sint culpa!
            Dolores perspiciatis maiores voluptates in doloremque optio illum eius accusantium temporibus ex veritatis quaerat esse cupiditate et, neque totam eos consectetur quibusdam consequuntur mollitia modi. Laudantium consequuntur quibusdam cum qui.
            Magni dolore mollitia nihil recusandae, blanditiis incidunt! Hic et soluta quisquam, necessitatibus eos libero quas, natus at fuga sapiente blanditiis harum sunt quibusdam veniam saepe corrupti ea similique provident quidem.
            Dolorum non tempore blanditiis aut fuga perspiciatis eos temporibus totam unde, iure illum dignissimos optio ipsam similique, quo id cupiditate laborum cumque vitae tenetur quam? Beatae temporibus at rerum delectus.
            Suscipit nostrum ut libero esse expedita, dignissimos natus praesentium quae, recusandae assumenda hic, repudiandae quas non? Animi nesciunt alias voluptatem sed tenetur. Debitis dolorum saepe ea nulla illo obcaecati natus?
            Quidem dignissimos amet dicta sunt commodi voluptas reiciendis ea excepturi numquam in. Excepturi velit obcaecati dolorem id molestiae tenetur voluptates impedit culpa eius consequatur, quas, sint, quod voluptatem eveniet neque.
        </p>
    </div>

</body>

</html>