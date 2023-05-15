<?php
require('../fpdf/fpdf.php');

class Plan
{
  private $planId;
  private $name;
  private $description;
  private $owner_id;

  public function __construct($planId, $name, $description, $owner_id)
  {
    $this->planId = $planId;
    $this->name = $name;
    $this->description = $description;

    // TODO: Exec a querry to use the owner's name instead
    $this->owner_id = $owner_id;
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
    return $this->owner_id;
  }

  public function setOwner($owner_id)
  {
    $this->owner_id = $owner_id;
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
