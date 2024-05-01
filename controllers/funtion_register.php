<?php
require_once('../src/Models/conexion.php');
use Models\Conexion;
$conn = new Conexion();

$pdo = $conn->getPdo();
// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Consulta SQL para verificar si el email ya existe
    $consulta_verificar_email = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
    $consulta_verificar_email->bindParam(':email', $email);
    $consulta_verificar_email->execute();
    $email_existente = $consulta_verificar_email->fetchColumn();
    
    // Comprobamos si el email ya existe
    if($email_existente > 0)
    {
        echo "<script>
            alert('Este email ya está registrado. Por favor utiliza otro');
            window.location.href = '../src/views/register.php';
        </script>";
    }
    else
    {
        // Verifica si las contraseñas coinciden
        if ($password === $confirm_password) 
        {
            if(strlen($password) >= 6)
            {
                try 
                {
                    // Preparamos la consulta de inserción
                    $consulta = $pdo->prepare("INSERT INTO user (name,  username, lastname, email, passwordHash, theme, image) VALUES (:name,  :username, :lastname, :email, :passwordHash, :theme, 'userdefault.png')");
    
                    // Bind de los parámetros
                    $theme = 0;
                    $consulta->bindParam(':name', $name);
                    $consulta->bindParam(':username', $nickname);
                    $consulta->bindParam(':lastname', $lastname);
                    $consulta->bindParam(':email', $email);
                    $consulta->bindParam(':theme', $theme);

                    // ciframos la contraseña
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    $consulta->bindParam(':passwordHash', $hashed_password);
    
                    // Ejecutamos la consulta
                    $consulta->execute();
    
                    // Enviamos el correo de confirmación
                    $to = $email;
                    $subject = "Confirmación de creación de cuenta";
                    $message = "Cuenta creada correctamente";
                    $headers = "From: alansanmillanr@gmail.com";

                    if(mail($to, $subject, $message, $headers))
                    {
                        echo "<script>
                            alert('Cuenta creada correctamente. se mando un codigo a su correo electronico);
                            window.location.href = '../src/views/login.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script>
                            alert('Cuenta creada correctamente. No se a podido enviar el correo');
                            window.location.href = '../src/views/login.php';
                        </script>";
                    }
                    exit();
                } 
                catch (PDOException $e) 
                {
                    // En caso de error, muestra un mensaje de error
                    $errorMessage = addslashes($e->getMessage());
                    echo "<script>
                        alert('Error de registro: " . $errorMessage . "');
                        console.log('Error de registro: " . $errorMessage . "');
                        window.location.href = '../src/views/register.php';
                    </script>";
                }
            }
            else
            {
                echo "<script>
                    alert('La contraseña debe tener al menos 6 caracteres');
                    window.location.href = '../src/views/register.php';
                </script>";  
            }
        } 
        else 
        {
            echo "<script>
                alert('Las contraseñas no coinciden.');
                window.location.href = '../src/views/register.php';
            </script>";
        }
    }
}
?>