<?php
require('../tfpdf/tfpdf.php');

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
  private $dependencies; // TODO
  private $aquiredSkills;
  private $contents;
  private $examSynopsis;
  private $bibliography;

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

    $owner_db = Queries::getUserById($owner_id);
    if (!$owner_db) {
      throw new PDOException("Invalid owner! Failed to construct Plan object");
    }

    $this->owner = $owner_db->getUsername();
  }

  public function generatePDF()
  {
    $pdf = new tFPDF();
    $pdf->AddPage();

    // Set font for the title
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 18);
    $pdf->Cell(0, 10, 'УЧЕБНА ПРОГРАМА', 0, 1, 'C');

    // Set font for the content
    $pdf->SetFont('DejaVu', '', 12);

    // Output the form data
    $pdf->Cell(40, 10, 'Type: ', 0, 0);
    $pdf->Cell(0, 10, $this->type, 0, 1);

    $pdf->Cell(40, 10, 'Name: ', 0);
    $pdf->Cell(0, 10, $this->name, 0, 1);

    $pdf->Cell(40, 10, 'Department: ', 0);
    $pdf->Cell(0, 10, $this->department, 0, 1);

    $pdf->Cell(40, 10, 'Owner: ', 0);
    $pdf->Cell(0, 10, $this->owner, 0, 1);

    $pdf->Cell(40, 10, 'Busyness: ', 0);
    $pdf->Cell(0, 10, $this->busyness, 0, 1);

    $pdf->Cell(40, 10, 'Credits: ', 0);
    $pdf->Cell(0, 10, $this->credits, 0, 1);

    $pdf->Cell(40, 10, 'Description: ', 0);
    $pdf->MultiCell(0, 10, $this->description, 0, 1);

    $pdf->Cell(40, 10, 'Required Skills: ', 0);
    $pdf->MultiCell(0, 10, $this->requiredSkills, 0, 1);

    $pdf->Cell(40, 10, 'Aquired Skills: ', 0);
    $pdf->MultiCell(0, 10, $this->aquiredSkills, 0, 1);

    $pdf->Cell(40, 10, 'Contents: ', 0);
    $pdf->MultiCell(0, 10, $this->contents, 0, 1);

    $pdf->Cell(40, 10, 'Exam Synopsis: ', 0);
    $pdf->MultiCell(0, 10, $this->examSynopsis, 0, 1);

    $pdf->Cell(40, 10, 'Bibliography: ', 0);
    $pdf->MultiCell(0, 10, $this->bibliography, 0, 1);

    $pdf->Cell(40, 10, 'Majors: ', 0);
    $pdf->MultiCell(0, 10, $this->targetMajors, 0, 1);

    $pdf->Output();
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

  public function setType($type)
  {
    $this->type = $type;
  }

  public function getTargetMajors()
  {
    return $this->targetMajors;
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
}
