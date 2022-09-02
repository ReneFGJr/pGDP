<?php
$conn = mysqli_connect("localhost","root","","chatbot");


if($conn)
{
    $user_messages = mysqli_real_escape_string($conn, $_POST['messageValue']);

    $query = "insert chatbot_answer (answer) values ('$user_messages')";

    $makeQuery = mysqli_query($conn, $query);

    $query = "SELECT * FROM chatbot WHERE messages LIKE '%$user_messages%'";
    $makeQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($makeQuery) > 0)
    {
        $result = mysqli_fetch_assoc($makeQuery);

        echo $result['response'];
    }else{
        echo "Desculpe, não sei nada sobre esse assunto.";
    }
}else {
    echo "Erro ao conectar com o banco de dados" . mysqli_connect_errno();
}
?>