<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }


    public function getProdottiCasuali($n=5) {
        $stmt = $this->db->prepare("SELECT * FROM prodotto ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }




    public function getRandomPosts($n){
        $stmt = $this->db->prepare("SELECT idarticolo, titoloarticolo, imgarticolo FROM articolo ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories(){
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($idcategory){
        $stmt = $this->db->prepare("SELECT nomecategoria FROM categoria WHERE idcategoria=?");
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($n=-1){
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo, anteprimaarticolo, dataarticolo, nome FROM articolo, autore WHERE autore=idautore ORDER BY dataarticolo DESC";
        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($id){
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo, testoarticolo, dataarticolo, nome FROM articolo, autore WHERE idarticolo=? AND autore=idautore";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByCategory($idcategory){
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo, anteprimaarticolo, dataarticolo, nome FROM articolo, autore, articolo_ha_categoria WHERE categoria=? AND autore=idautore AND idarticolo=articolo";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByIdAndAuthor($id, $idauthor){
        $query = "SELECT idarticolo, anteprimaarticolo, titoloarticolo, imgarticolo, testoarticolo, dataarticolo, (SELECT GROUP_CONCAT(categoria) FROM articolo_ha_categoria WHERE articolo=idarticolo GROUP BY articolo) as categorie FROM articolo WHERE idarticolo=? AND autore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$id, $idauthor);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByAuthorId($id){
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo FROM articolo WHERE autore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore){
        $query = "INSERT INTO articolo (titoloarticolo, testoarticolo, anteprimaarticolo, dataarticolo, imgarticolo, autore) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssi',$titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateArticleOfAuthor($idarticolo, $titoloarticolo, $testoarticolo, $anteprimaarticolo, $imgarticolo, $autore){
        $query = "UPDATE articolo SET titoloarticolo = ?, testoarticolo = ?, anteprimaarticolo = ?, imgarticolo = ? WHERE idarticolo = ? AND autore = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssii',$titoloarticolo, $testoarticolo, $anteprimaarticolo, $imgarticolo, $idarticolo, $autore);
        
        return $stmt->execute();
    }

    public function deleteArticleOfAuthor($idarticolo, $autore){
        $query = "DELETE FROM articolo WHERE idarticolo = ? AND autore = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idarticolo, $autore);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }

    public function insertCategoryOfArticle($articolo, $categoria){
        $query = "INSERT INTO articolo_ha_categoria (articolo, categoria) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$articolo, $categoria);
        return $stmt->execute();
    }

    public function deleteCategoryOfArticle($articolo, $categoria){
        $query = "DELETE FROM articolo_ha_categoria WHERE articolo = ? AND categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$articolo, $categoria);
        return $stmt->execute();
    }

    public function deleteCategoriesOfArticle($articolo){
        $query = "DELETE FROM articolo_ha_categoria WHERE articolo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$articolo);
        return $stmt->execute();
    }

    public function getAuthors(){
        $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti FROM categoria, articolo, autore, articolo_ha_categoria WHERE idarticolo=articolo AND categoria=idcategoria AND autore=idautore AND attivo=1 GROUP BY username, nome";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($username, $password){
        $query = "SELECT * FROM utente WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }    

    public function getOrdiniUtente(){
        $query = "SELECT * FROM ordine WHERE utente_email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$_SESSION["email"]);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificheUtente($email){
        $query = "SELECT * FROM notifiche WHERE utente_email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function trovaUtente($email) {
        $query = "SELECT * FROM utente WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function registerUser($nome, $password, $email,$cognome) {
        $query = "INSERT INTO utente(nome, password, email,cognome,tipoUtente) VALUES (?, ?, ?, ?, NULL)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss',$nome, $password, $email, $cognome);
        return $stmt->execute();
    }

    public function inserisciNotifica($email, $messaggio,$link=NULL) {
        $query = "INSERT INTO notifiche(messaggio,utente_email,link) VALUES (?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss',$messaggio,  $email,$link);
        return $stmt->execute();
    }

    public function getProdotto($idProdotto) {
        $query = "SELECT * FROM prodotto WHERE idProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idProdotto);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function trovaOrdini() {
        $query = "SELECT * FROM ordine ORDER BY idOrdine DESC ";
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function crea_ordine($totale) {
        $query = "INSERT INTO ordine(utente_email,prezzoTotale) 
                    VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sd',$_SESSION["email"],$totale);
        $stmt->execute();

        $ordine=$this->trovaOrdini()[0];

        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);
        foreach($cart as $c) {
            $result=$this->modificaProdotto($c->prodotto->nome,$c->prodotto->descrizione,$c->prodotto->prezzo,$c->prodotto->sconto,$c->prodotto->quantita-$c->quantita,$c->prodotto->img,$c->prodotto->idProdotto);
            if ($result) {
                $query = "INSERT INTO dettaglio_ordine(prezzo,quantita,ordine_idOrdine,prodotto_idProdotto,prodotto_nome,prodotto_img) 
                            VALUES (?,?,?,?,?,?)";
                
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('diiiss',$c->prezzo,$c->quantita,$ordine["idOrdine"],$c->prodotto->idProdotto,$c->prodotto->nome,$c->prodotto->img); 
                $stmt->execute();  
            }
        }   
        return $stmt->execute();
    }

    public function getProdottiCasualiTutti($n=4) {
        $stmt = $this->db->prepare("SELECT * FROM prodotto ORDER BY RAND()");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminaProdotto($idProdotto) {
        $query = "DELETE FROM prodotto WHERE idProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idProdotto);
        return $stmt->execute();
    }

    public function inserisciProdotto($nome,$descrizione,$prezzo,$sconto,$quantita,$img) {
        $query = "INSERT INTO prodotto(nome,descrizione,prezzo,sconto,quantita,img) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssddis',$nome,$descrizione,$prezzo,$sconto,$quantita,$img);
        return $stmt->execute();
    }

    public function modificaProdotto($nome, $descrizione, $prezzo, $sconto,$quantita, $img, $idProdotto){
        if ($quantita==0) {
            $result=$this->inserisciNotifica("admin@admin","E' finito il prodotto con id:".$idProdotto,"product-detail.php?idProdotto=".$idProdotto);
        }
        $query = "UPDATE prodotto SET nome = ?, descrizione = ?, prezzo = ?, sconto = ?, quantita= ?, img = ? WHERE idProdotto = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssddisi',$nome, $descrizione, $prezzo, $sconto, $quantita, $img, $idProdotto);
        
        return $stmt->execute();
    }

    public function prendiOrdine($idOrdine) {
        $query = "SELECT * FROM dettaglio_ordine WHERE ordine_idOrdine = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idOrdine);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }
      
    public function ottieniUltimoid($table){
        $query="SELECT LAST_INSERT_ID() FROM ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$table);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastId(){
        $last_id = mysqli_insert_id($this->db);
        return $last_id;
    }

    public function getTuttiOrdini() {
        $stmt = $this->db->prepare("SELECT * FROM ordine ");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastOrdine() {
        $stmt = $this->db->prepare("SELECT * FROM ordine ORDER BY idOrdine DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>