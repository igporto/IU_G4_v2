<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/EMPLOYEE.php");
require_once(__DIR__ . "/../model/USER.php");
require_once(__DIR__ . "/../model/USER_model.php");
require_once(__DIR__ . "/../model/INJURY_model.php");


class EmployeeMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $userMapper;
    private $injuryMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->userMapper = new UserMapper();
        $this->injuryMapper = new InjuryMapper();
    }

    public function employeedniExists($codemployee)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM empleado where dni = ?");
        $stmt->execute(array($codemployee));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //añade unha actividade á táboa activiade
    public function add(Employee $employee)
    {
        //insertamos na taboa empleado

        $stmt = $this->db->prepare("
                  INSERT INTO empleado(dni, nombre, apellidos, fech_nac, direccion_postal, email, comentario_personal, hora_entrada, hora_salida, num_cuenta, tipo_contrato, cod_usuario) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->execute(array(
                $employee->getEmployeedni(),
                $employee->getEmployeename(),
                $employee->getEmployeesurname(),
                $employee->getBirthdate(),
                $employee->getAddress(),
                $employee->getEmail(),
                $employee->getComment(),
                $employee->getHourIn(),
                $employee->getHourOut(),
                $employee->getBanknum(),
                $employee->getContracttype(),
                $employee->getUser()->getCoduser()
            )
        );

        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos Employee correspondentes á taboa empleado
    public function show()
    {
        //obtemos os datos da taboa usuario
        $stmt = $this->db->query("SELECT * FROM empleado");
        $employees_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employees = array();

        //por cada empleado, obtemos os datos e creamos un obxeto no que se insertan
        foreach ($employees_db as $emp) {
            //engadimos o usuario cos seus permisos a $users
            array_push($employees, $this->view($emp["id_empleado"]));
        }
        //devolve o array
        return $employees;
    }

    //devolve o obxecto Activity no que o $codactivity coincida co da tupla.
    public function view($codemployee)
    {
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id_empleado = ?");
        $stmt->execute(array($codemployee));
        $emp = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($emp != null) {
            return new Employee(
                $emp['id_empleado'],
                $emp['dni'],
                $emp['nombre'],
                $emp['apellidos'],
                $emp['fech_nac'],
                $emp['direccion_postal'],
                $emp['email'],
                $emp['comentario_personal'],
                $emp['hora_entrada'],
                $emp['hora_salida'],
                $emp['num_cuenta'],
                $emp['tipo_contrato'],
                $this->userMapper->view($emp['cod_usuario'])
            );
        } else {
            return new Employee();
        }
    }

    //edita a tupla correspondente co id do obxecto Employee $employee
    public function edit(Employee $employee)
    {
        $stmt = $this->db->prepare("
                      UPDATE empleado SET dni = ?, nombre = ?, apellidos = ?, fech_nac = ?, direccion_postal = ?, email= ?, 
                          comentario_personal= ?, hora_entrada= ?, hora_salida= ?, num_cuenta= ?, tipo_contrato= ?, cod_usuario= ?  
                      WHERE id_empleado = ?");
        $stmt->execute(array(
                $employee->getEmployeedni(), $employee->getEmployeename(), $employee->getEmployeesurname(), $employee->getBirthdate(), $employee->getAddress(), $employee->getEmail(),
                $employee-> getComment(), $employee->getHourIn(), $employee->getHourOut(), $employee->getBanknum(), $employee->getContracttype(), $employee->getUser()->getCoduser(), $employee->getCodemployee()
            )
        );
    }

    //borra sobre a taboa empleado a tupla con id igual a o do obxeto pasado
    public function delete($codemployee)
    {
        $stmt = $this->db->prepare("DELETE from empleado WHERE id_empleado = '$codemployee'");
        $stmt->execute();
    }

    public function search(Employee $employee){
        if($employee->getUser()->getCoduser() == NULL) {
            $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id_empleado like ? AND dni like ? AND nombre like ? AND apellidos like ?
                                        AND direccion_postal like ? AND  tipo_contrato like ? ");
            $stmt->execute(array( "%".$employee->getCodemployee()."%", "%".$employee->getEmployeedni()."%", "%".$employee->getEmployeename()."%",
                "%".$employee->getEmployeesurname()."%", "%".$employee->getAddress()."%",
                "%".$employee->getContracttype()."%"
            ));
        }else{
            $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id_empleado like ? AND dni like ? AND nombre like ? AND apellidos like ?
                                        AND direccion_postal like ? AND  tipo_contrato like ? AND cod_usuario = ? ");

            $stmt->execute(array( "%".$employee->getCodemployee()."%", "%".$employee->getEmployeedni()."%", "%".$employee->getEmployeename()."%",
                "%".$employee->getEmployeesurname()."%", "%".$employee->getAddress()."%",
                "%".$employee->getContracttype()."%", $employee->getUser()->getCoduser()
            ));
        }


        $employees_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employees = array();
        foreach ($employees_db as $e){
            array_push($employees, $this->view($e["id_empleado"]));
        }
        return $employees;
    }

    public function validar_fecha_nac($date){

        $stmt = $this->db->query("SELECT CURDATE()");
        $db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($db != NULL){
            $actual = $db[0];

            if ($date < $actual['CURDATE()']) {
                return true;
            } else {
                return false;
            }
        }


    }

    public function addinjury(Employeehasinjury $phi){
        $stmt = $this->db->prepare("INSERT INTO empleado_tiene_lesion (id_empleado, id_lesion, fecha_lesion) 
                                    VALUES (?, ?, ?)");
        $stmt->execute(array($phi->getEmployee()->getCodemployee(), $phi->getInjury()->getCodInjury(), $phi->getDateInjury()));

        return $this->db->lastInsertId();
    }

    public function showinjury(Employee $employee){
        $stmt = $this->db->prepare("SELECT * FROM empleado_tiene_lesion  WHERE id_empleado = ?");
        $stmt->execute(array($employee->getCodemployee()));
        $injury_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $injurys = array();

        foreach ($injury_db as $injury) {
            array_push($injurys, $this->viewInjury($injury['id_empleado_tiene_lesion']));
        }
        return $injurys;
    }

    public function deleteinjury($codinjuryemployee){
        $stmt = $this->db->prepare("DELETE from empleado_tiene_lesion WHERE id_empleado_tiene_lesion = ?");
        $stmt->execute(array( $codinjuryemployee ));
    }

    public function editinjury(Employeehasinjury $phi)
    {
        $stmt = $this->db->prepare("UPDATE empleado_tiene_lesion SET fecha_recuperacion = ? WHERE id_empleado_tiene_lesion = ?");
        $stmt->execute(array($phi->getDateRecovery(), $phi->getCod()));
    }

    public function viewInjury($codinjuryemployee){
        $stmt = $this->db->prepare("SELECT * FROM empleado_tiene_lesion WHERE id_empleado_tiene_lesion =?");
        $stmt->execute(array($codinjuryemployee));
        $phi = $stmt->fetch(PDO::FETCH_ASSOC);

        if($phi != null) {
            return new Employeehasinjury(
                $phi['id_empleado_tiene_lesion'],
                $this->view($phi['id_empleado']),
                $this->injuryMapper->view($phi['id_lesion']),
                $phi['fecha_lesion'],
                $phi['fecha_recuperacion']
            );
        } else {
            return new Employeehasinjury();
        }
    }
    public function validInjurydate($date)
    {

        $stmt = $this->db->query("SELECT CURDATE()");
        $db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($db != NULL) {
            $actual = $db[0];

            if ($date <= $actual['CURDATE()']) {
                return true;
            } else {
                return false;
            }
        }
    }
}
