<?php
require('../fpdf/fpdf.php');

// TODO: maybe its better if the constructor creates a plan in the db.
// Now it's the other way around - queries get a row and return a model.
class Plan
{
  private $planId;

  // Избираема/Задължителна
  private $type;
  private $targetMajors;
  private $name;
  private $department;
  private $owner;
  private $busyness;
  private $credits;
  private $description;
  private $requiredSkills;
  //Other plans
  private $dependencies;
  private $learnedSkills;
  private $contents;
  private $examSynopsis;
  private $bibliography;

  public function __construct($planId, $name, $description, $owner_id)
  {
    $this->planId = $planId;
    $this->name = $name;
    $this->description = $description;

    $owner_db = Queries::getUserById($owner_id);
    if (!$owner_db) {
      throw new PDOException("Invalid owner! Failed to construct Plan object");
    }

    $this->owner = $owner_db->getUsername();
  }

  public function generatePDF()
  {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(100, 20, $this->name);
    $pdf->Cell(100, 18, $this->description);

    // TODO: request to get the owner's name
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

  public function getLearnedSkills()
  {
    return $this->learnedSkills;
  }

  public function setLearnedSkills($learnedSkills)
  {
    $this->learnedSkills = $learnedSkills;
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
