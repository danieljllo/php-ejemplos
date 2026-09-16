<?php

class Circle
{
    private int $size;
    private string $color;
    private string $text;
    private string $textColor;

    /**
     * @param int $size Diameter of the circle container in pixels
     * @param string $color Fill/Stroke color (HEX, RGB, or named color)
     * @param string $text Optional text to render inside the circle
     * @param string $textColor Text color (default: white)
     */
    public function __construct(
        int $size = 100, 
        string $color = '#3498db', 
        string $text = '', 
        string $textColor = '#ffffff'
    ) {
        $this->size = $size;
        $this->color = htmlspecialchars($color, ENT_QUOTES, 'UTF-8');
        $this->text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $this->textColor = htmlspecialchars($textColor, ENT_QUOTES, 'UTF-8');
    }

    // Setters
    public function setSize(int $size): void { $this->size = $size; }
    public function setColor(string $color): void { $this->color = htmlspecialchars($color, ENT_QUOTES, 'UTF-8'); }
    public function setText(string $text): void { $this->text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); }
    public function setTextColor(string $textColor): void { $this->textColor = htmlspecialchars($textColor, ENT_QUOTES, 'UTF-8'); }

    /**
     * Helper to wrap shapes and text into an SVG container
     */
    private function buildSvg(string $shapeContent): string
    {
        $center = $this->size / 2;
        $fontSize = max(12, (int)($this->size * 0.18)); // Scale font dynamically based on circle size

        $textElement = '';
        if ($this->text !== '') {
            $textElement = sprintf(
                '<text x="%1$d" y="%1$d" fill="%2$s" font-size="%3$d" font-family="sans-serif" text-anchor="middle" dominant-baseline="central">%4$s</text>',
                $center,
                $this->textColor,
                $fontSize,
                $this->text
            );
        }

        return sprintf(
            '<svg width="%1$d" height="%1$d" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle;">%2$s%3$s</svg>',
            $this->size,
            $shapeContent,
            $textElement
        );
    }

    /**
     * Renders a solid SVG circle.
     */
    public function drawSolid(): string
    {
        $center = $this->size / 2;
        $shape = sprintf(
            '<circle cx="%1$d" cy="%1$d" r="%1$d" fill="%2$s" />',
            $center,
            $this->color
        );

        return $this->buildSvg($shape);
    }

    /**
     * Renders an outlined SVG circle.
     */
    public function drawOutlined(int $strokeWidth = 4): string
    {
        $center = $this->size / 2;
        $radius = $center - ($strokeWidth / 2); // Prevent stroke clipping along bounding box edge

        $shape = sprintf(
            '<circle cx="%1$d" cy="%1$d" r="%2$f" fill="none" stroke="%3$s" stroke-width="%4$d" />',
            $center,
            $radius,
            $this->color,
            $strokeWidth
        );

        return $this->buildSvg($shape);
    }
}

// --- Example Usage ---

$solidoConTexto = new Circle(120, '#e74c3c', 'NO FUMAR', '#ffffff');
$circunferenciaConTexto = new Circle(140, '#2ecc71', 'Hola!', '#2ecc71');
$circuloChico = new Circle(80, '#3498db', 'Uruguay');
$otroCirculoChico = clone $circuloChico;
$otroCirculoChico->setColor('#e74c3c');
$otroCirculoChico->setSize(95);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POO Clase Circle con SVG</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f6f8; padding: 2rem; }
        .container { display: flex; gap: 2rem; align-items: center; background: #fff; padding: 2rem; border-radius: 8px; }
        .card { text-align: center; }
        p { margin-top: 0.5rem; color: #555; font-size: 0.9rem; }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <?= $solidoConTexto->drawSolid(); ?>
            <p>Circulo Sólido con texto NO FUMAR</p>
        </div>

        <div class="card">
            <?= $circunferenciaConTexto->drawOutlined(6); ?>
            <p>Circunferencia de borde verde con texto Hola</p>
        </div>

        <div class="card">
            <?= $circuloChico->drawSolid(); ?>
            <p>Circulo Sólido con texto Uruguay</p>
        </div>

        <div class="card">
            <?= $otroCirculoChico->drawSolid(); ?>
            <p>Copia del Circulo Sólido con texto Uruguay, cambiando color y tamaño</p>
        </div>
    </div>

</body>
</html>