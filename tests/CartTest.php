<?php
use App\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    protected $cart;

    protected function setUp(): void
    {
        $this->cart = new Cart();
    }

    protected function tearDown(): void
    {
        // Khôi phục giá trị thuế về mặc định sau mỗi bài kiểm thử
        Cart::$tax = 1.2;
    }

    /** @test */
    public function the_cart_tax_value_can_be_changed_statically()
    {
        // Thay đổi giá trị thuế tĩnh
        Cart::$tax = 1.5;
        $this->cart->price = 10;
        $netPrice = $this->cart->getNetPrice();

        // Kiểm tra giá trị thuế được thay đổi chính xác
        $this->assertEquals(15, $netPrice);
    }

    /** @test */
    public function testCorrectNetPriceIsReturned()
    {
        // Kiểm tra phương thức getNetPrice với giá trị thuế mặc định
        $this->cart->price = 10;
        $netPrice = $this->cart->getNetPrice();

        // Kiểm tra xem giá trị trả về có đúng như mong đợi
        $this->assertEquals(12, $netPrice);
    }

    /** @test */
    public function testGetNetPriceForZeroPrice()
    {
        // Kiểm tra với giá trị price bằng 0
        $this->cart->price = 0;
        $netPrice = $this->cart->getNetPrice();

        // Xác nhận rằng net price vẫn là 0
        $this->assertEquals(0, $netPrice);
    }

    /** @test */
    public function testGetNetPriceForNegativePrice()
    {
        // Kiểm tra với giá trị price âm
        $this->cart->price = -10;
        $netPrice = $this->cart->getNetPrice();

        // Xác nhận giá trị net price cho giá trị âm
        $this->assertEquals(-12, $netPrice);
    }

    /** @test */
    public function a_type_error_is_thrown_when_trying_to_add_a_non_int_to_the_price()
    {
        try {
            // Thử thêm một giá trị không phải là kiểu int vào price
            $this->cart->addToPrice('fifteen');
            $this->fail('A TypeError should have been thrown');
        } catch (TypeError $error) {
            // Kiểm tra thông báo lỗi đúng
            $this->assertStringStartsWith('App\\Cart::addToPrice():', $error->getMessage());
        }
    }

    /** @test */
    public function adding_valid_amount_to_price_increases_the_price_correctly()
    {
        // Kiểm tra với một số hợp lệ
        $this->cart->price = 10;
        $this->cart->addToPrice(5);

        // Xác nhận giá trị price sau khi thêm số tiền hợp lệ
        $this->assertEquals(15, $this->cart->price);
    }

    /** @test */
    public function adding_negative_amount_to_price_decreases_the_price_correctly()
    {
        // Kiểm tra với số âm
        $this->cart->price = 10;
        $this->cart->addToPrice(-5);

        // Xác nhận giá trị price sau khi trừ số tiền âm
        $this->assertEquals(5, $this->cart->price);
    }
}
?>