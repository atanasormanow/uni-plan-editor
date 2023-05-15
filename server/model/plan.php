<?php
require('../fpdf/fpdf.php');

// TODO: maybe its better if the constructor creates a plan in the db.
// Now it's the other way around - queries get a row and return a model.
class Plan
{
  private $planId;
  private $name;
  private $description;
  private $owner;

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
}
