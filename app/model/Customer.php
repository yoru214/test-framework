<?php
class Customer extends AppModel
{
    function add()
    {
        $name = $this->setname();
        $sql = "insert into customers (name) values('".$name."')";
        $this->query($sql);
        $args = array('conditions'=> array('name'=>$name));
        return $this->find($args);

    }

    function setFunds()
    {
        $sql = "SELECT c.id, (c.`funds` - SUM(IFNULL((p.price * p.quantity),0))) AS 'funds'  FROM customers c LEFT JOIN purchases p ON p.`customer_id` = c.id  WHERE c.id = " . $_SESSION['Auth']->id;
        $result = $this->query($sql);
        $row = mysqli_fetch_object($result);
        $_SESSION['Auth']->funds = $row->funds;
    }

    function setName()
    {
        $strnames =
        "Kathleen Weekly,
        Lucila Hinojosa,
        Cordelia Stanbery,
        Delphine Horan,
        Lorinda Renner,
        Danuta Elsner,
        Nikita Disla,
        Shelley Farrar,
        Bessie Tschanz,
        Ilona Winningham,
        Howard Sundstrom,
        Alysha Kappel,
        Lorenzo Dusek,
        Minda Espy,
        Lavette Grosz,
        Brigitte Record,
        Orpha Liefer,
        Andrew Galligan,
        Odis Longtin,
        Taylor Stormer,
        Leonore Ramires,
        Miki Nyberg,
        Niki Venuti,
        Manuel Clingan,
        Alexandria Kinghorn,
        Norberto Bettes,
        Glinda Spoor,
        Tenisha Summerall,
        Jamila Thweatt,
        Alfonzo Gathings,
        Bradley Vogelsang,
        Tammie Mckissack,
        Clare Bodden,
        Louetta Racey,
        Hilda Donadio,
        Kimi Calmes,
        Mechelle Dortch,
        Andrea Allsup,
        Bethann Charette,
        Prince Keegan,
        Yung Weick,
        Leone Anspach,
        Karin Coe,
        Adriana Payeur,
        Janita Criss,
        Kiersten Bertolini,
        Hanna Cram,
        Yolando Hemstreet,
        Shanti Frisina,
        Oscar Blay,
        Genia Burgett,
        Mathilda Nilges,
        Edra Amsden,
        Yolando Chapple,
        Leisha Hilliker,
        Nobuko Meis,
        France Mcdevitt,
        Elayne Johansson,
        Danielle Mcquaig,
        Yu Lank,
        Georgette Ellard,
        Nenita Runyan,
        Laureen Lejeune,
        Gregorio Hammes,
        Ayana Ingles,
        Arnoldo Burgess,
        Julius Galley,
        Wallace Ellenwood,
        Elwanda Conlin,
        Isobel Wachter,
        Rayford Lindo,
        Nidia Macleod,
        Louanne Profitt,
        Roxann Vanatta,
        Tennille Strahan,
        Everett Ives,
        Altha Hyndman,
        Emmie Sabbagh,
        Lavonia Cogar,
        Dessie Rolls,
        Dusty Mojarro,
        Cammy Enriguez,
        Odis Merlos,
        Rick Strait,
        Minerva Huson,
        Stevie Strub,
        Mistie Vanzile,
        Lady Gudino,
        Barbra Pechacek,
        Deirdre Swords,
        Jerica Spires,
        Leeann Ramos,
        Kellee Mier,
        Zachery Arbuckle,
        Danyell Jakes,
        Reginald Welden,
        Judson Hartung,
        Ora Plain,
        Shayla Mcadory,
        Jamika Ress";

        $names = explode(",", $strnames);

        return trim($names[rand(0, count($names)-1)]);
    }
    
}
?>
