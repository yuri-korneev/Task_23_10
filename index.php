<?php

interface WiperTrimInterface {
  public function wiper();
  public function innerTrim();
}

interface TransportInterface {
  const engine = true;
  public function MoveForward();
  public function MoveBack(); 
  public function signal();
}

abstract class Transport implements TransportInterface {
  const material = 'metal';
  public function MoveForward() {
    echo ("Moving forward\n");
  }
  public function MoveBack() {
    echo ("Moving back\n");
  }

  protected function PowerOnPhrase() {
    echo $this->phrase;
  }

}

class Tank extends Transport {
  protected $phrase = 'Turn lever';
  protected $horn = 'hoot';
  protected $shells = 10;

  public function PowerOn() {
    $this->PowerOnPhrase();
  }

  public function signal(){
    echo "$this->horn/n";
  }

  public function GunLeft() {
      echo ("Gun moving left\n");
    }

  public function GunRight() {
      echo ("Gun moving rigt\n");
    }

  public function checkShells()
    {
      return $this->shells > 0;
    }

  public function shoot(){
      if ($this->checkShells()){
          echo ("Fire!\n");
          $this->shells -=1;
          echo "Remaining shells = $this->shells" , "\n";
      } else {
          echo ("Shells empty\n");
      }
  }

}

abstract class AbstractCar extends Transport implements WiperTrimInterface {
  const airbagMin = 1;
  protected $horn = 'beep';
  protected $phrase = 'Turn key';
  protected $innerMaterial = '';

  public function signal(){
    echo "$this->horn\n";
  }
  public function wiper() {
    echo ("Wiper moving\n");
  }

}

class Car extends AbstractCar {
  const airbagMin = 2;
  const doors = 4;
  protected $innerMaterial = 'leather';
  protected $form = 'sedan';
  protected $nitrous = 30;
  
  public function checkNitrous()
    {
      return $this->nitrous > 0;
    }

  public function acceleration(){
      if ($this->checkNitrous()){
          echo ("Acceleration On\n");
      } else {
          echo ("Nitrous empty\n");
      }
  }

  public function innerTrim() {
    echo "$this->innerMaterial\n";
  }

}

abstract class SpecEquip extends Transport implements WiperTrimInterface {
  const fuel = 'disel';
  protected $horn = 'alarm';
  protected $phrase = 'Turn button';
  protected $innerMaterial = '';
  protected $specDevice = '';


public function checkSpecDevice()
  {
    return $this->specDevice;
  }

  public function innerTrim() {
    echo "$this->innerMaterial\n";
  }

  public function signal(){
    echo "$this->horn\n";
  }
  public function wiper() {
    echo ("Wiper moving\n");
  }

}


class Bulldozer extends SpecEquip {
  
  const color = 'yellow';
  const fuel = 'disel 80';
  protected $specDevice = 'dipper';
  protected $innerMaterial = 'leatherette';

  public function innerTrim() {
    echo "$this->innerMaterial\n";
  }

  public function dipperControl(){
    if ($this->checkSpecDevice()){
        echo ("$this->specDevice On\n");
    } else {
        echo ("No SpecDevice\n");
    }
  }

}
function testTransport(Transport $transport) {
  $transport->MoveForward();
  if ($transport == new Car) {
    $transport->acceleration();
  } else if ($transport == new Bulldozer) {
    $transport->dipperControl();
  } else {
    echo "Ability is undefined";
  }
}

?>