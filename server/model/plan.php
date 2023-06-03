<?php
require('../lib/tfpdf/tfpdf.php');

// TODO: maybe its better if the constructor creates a plan in the db.
// Now it's the other way around - queries select a row and return a model.
class Plan
{
  private $planId;

  private $type;
  private $targetMajors;
  private $name;
  private $department;
  private $owner;
  private $busyness;
  private $credits;
  private $description;
  private $requiredSkills;
  private $dependencies;
  private $aquiredSkills;
  private $contents;
  private $examSynopsis;
  private $bibliography;

  // TODO: pass json/map instead to avoid messing up the arguments order
  public function __construct(
    $planId,
    $owner_id,
    $type,
    $targetMajors,
    $name,
    $department,
    $busyness,
    $credits,
    $description,
    $requiredSkills,
    $aquiredSkills,
    $contents,
    $examSynopsis,
    $bibliography,
  ) {
    $this->planId = $planId;
    $this->type = $type;
    $this->targetMajors = $targetMajors;
    $this->name = $name;
    $this->department = $department;
    $this->busyness = $busyness;
    $this->credits = $credits;
    $this->description = $description;
    $this->requiredSkills = $requiredSkills;
    $this->aquiredSkills = $aquiredSkills;
    $this->contents = $contents;
    $this->examSynopsis = $examSynopsis;
    $this->bibliography = $bibliography;

    $ownerFromDb = Queries::getUserById($owner_id);
    if (!$ownerFromDb) {
      throw new PDOException("Invalid owner! Failed to construct Plan object");
    }

    $this->owner = $ownerFromDb->getUsername();

    $this->dependencies = array();
    foreach (Queries::getPlanDependencies() as $row) {
      if ($row['plan_id_main'] === $planId) {
        array_push($this->dependencies, $row['plan_id_dependency']);
      }
    }
  }

  public function generatePDF()
  {
    $pdf = new tFPDF();
    $pdf->AddPage('P', 'A4');

    $pdf->AddFont('DejaVu', '', 'DejaVuSans.ttf', true);
    $pdf->AddFont('DejaVu-Bold', '', 'DejaVuSans-Bold.ttf', true);

    $pdf->SetFont('DejaVu', '', 18);
    $pdf->SetTitle('УЧЕБНА ПРОГРАМА', true);
    $pdf->Cell(0, 10, 'УЧЕБНА ПРОГРАМА', 0, 1, 'C');
    $pdf->Ln();

    $pdf->SetFont('DejaVu', '', 12);

    $this->writeCell('Тип дисциплина', $this->getReadableType(), $pdf);
    $this->writeCell('Специалност', $this->getReadableTargetMajors(), $pdf);
    $this->writeCell('Дисциплина', $this->name, $pdf);
    $this->writeCell('Катедра', $this->department, $pdf);
    $this->writeCell('Титуляр', $this->owner, $pdf);
    $this->writeCell('Заетост', $this->busyness, $pdf);
    $this->writeCell('Кредити', $this->credits, $pdf);
    $this->writeText('Анотация на учебната дисциплина', $this->description, $pdf);
    $this->writeText('Предварителни изисквания', $this->requiredSkills, $pdf);
    $this->writeText('Очаквани резултати', $this->aquiredSkills, $pdf);
    $this->writeText('Учебно съдържание', $this->contents, $pdf);
    $this->writeText('Конспект за изпит', $this->examSynopsis, $pdf);
    $this->writeText('Библиография', $this->bibliography, $pdf);

    $pdf->Output();
  }

  public function expose()
  {
    return get_object_vars($this);
  }

  public function getPlanId()
  {
    return $this->planId;
  }

  public function setPlanId($planId)
  {
    $this->planId = $planId;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getOwner()
  {
    return $this->owner;
  }

  public function setOwner($owner)
  {
    $this->owner = $owner;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getReadableType()
  {
    return $this->type == 'z' ? 'Задължителна' : 'Избираема';
  }

  public function setType($type)
  {
    $this->type = $type;
  }

  public function getTargetMajors()
  {
    return $this->targetMajors;
  }

  public function getReadableTargetMajors()
  {
    $readableMajors = array_map(
      function ($major) {
        switch ($major) {
          case 'i':
            return 'Информатика';
            break;
          case 'is':
            return 'Информационни системи';
            break;
          case 'kn':
            return 'Компютърни науки';
            break;
          case 'si':
            return 'Софтуерно инженерство';
            break;
          case 'ad':
            return 'Анализ на данни';
            break;
          case 'm':
            return 'Математика';
            break;
          case 'pm':
            return 'Приложна математика';
            break;
          case 's':
            return 'Статистика';
            break;
          case 'mi':
            return 'Математика и информатика';
            break;
          default:
            throw new UnexpectedValueException('Invalid major value');
            break;
        }
      },
      explode(',', $this->targetMajors)
    );
    return implode(', ', $readableMajors);
  }

  public function setTargetMajors($targetMajors)
  {
    $this->targetMajors = $targetMajors;
  }

  public function getDepartment()
  {
    return $this->department;
  }

  public function setDepartment($department)
  {
    $this->department = $department;
  }

  public function getBusyness()
  {
    return $this->busyness;
  }

  public function setBusyness($busyness)
  {
    $this->busyness = $busyness;
  }

  public function getCredits()
  {
    return $this->credits;
  }

  public function setCredits($credits)
  {
    $this->credits = $credits;
  }

  public function getRequiredSkills()
  {
    return $this->requiredSkills;
  }

  public function setRequiredSkills($requiredSkills)
  {
    $this->requiredSkills = $requiredSkills;
  }

  public function getDependencies()
  {
    return $this->dependencies;
  }

  public function setDependencies($dependencies)
  {
    $this->dependencies = $dependencies;
  }

  public function getAquiredSkills()
  {
    return $this->aquiredSkills;
  }

  public function setAquiredSkills($aquiredSkills)
  {
    $this->aquiredSkills = $aquiredSkills;
  }

  public function getContents()
  {
    return $this->contents;
  }

  public function setContents($contents)
  {
    $this->contents = $contents;
  }

  public function getExamSynopsis()
  {
    return $this->examSynopsis;
  }

  public function setExamSynopsis($examSynopsis)
  {
    $this->examSynopsis = $examSynopsis;
  }

  public function getBibliography()
  {
    return $this->bibliography;
  }

  public function setBibliography($bibliography)
  {
    $this->bibliography = $bibliography;
  }

  // Private functions
  ////////////////////
  private function writeCell($section, $content, $pdf)
  {
    $pdf->SetFont('DejaVu-Bold', '', 12);
    $pdf->Cell($pdf->GetStringWidth($section) + 5, 10, $section . ':', 0, 0);

    $pdf->SetFont('DejaVu', '', 12);
    $pdf->Cell(0, 10, $content, 0, 1);
  }

  private function writeText($section, $content, $pdf)
  {
    $pdf->SetFont('DejaVu-Bold', '', 12);
    $pdf->Cell($pdf->GetStringWidth($section) + 5, 10, $section . ':', 0, 1);

    $pdf->SetFont('DejaVu', '', 12);
    $pdf->Write(5, $content);
    $pdf->Ln();
  }
}
