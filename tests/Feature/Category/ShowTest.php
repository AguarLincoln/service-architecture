<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use DatabaseTransactions;

    private ?Company $company = null;
    private int $countCategories = 0;
    private ?Category $firstCategoryTest = null;
    private ?Category $lastCategoryTest = null;

    public function setUp(): void
    {
        parent::setUp();
        $email = 'empresa@gmail.com';

        $this->company = Company::where('email', $email)->first();

        if(!$this->company){
            $this->company = Company::factory()->create([
                'email' => $email,
                'password' => Hash::make('123456'),
            ]);
        }

        $categoryPizza = Category::where('name', 'Pizza')->first();
        
        if(!$categoryPizza){
            $categoryPizza = Category::factory()->create(['name' => 'Pizza']);
        }

        $categoryHamburger = Category::where('name', 'Hamburger')->first();

        if(!$categoryHamburger){
            $categoryHamburger = Category::factory()->create(['name' => 'Hamburger']);
        }

        $this->lastCategoryTest = Category::where('name', 'Sushi')->first();

        if(!$this->lastCategoryTest){
            $this->lastCategoryTest = Category::factory()->create(['name' => 'Sushi']);
        }

        $this->firstCategoryTest = Category::where('name', 'Alomoço')->first();

        if(!$this->firstCategoryTest){
            $this->firstCategoryTest = Category::factory()->create(['name' => 'Alomoço']);
        }

        $this->countCategories = $this->company->categories()->count();

        $this->company->categories()->attach($categoryPizza->id);
        $this->company->categories()->attach($categoryHamburger->id);
        $this->company->categories()->attach($this->lastCategoryTest->id);
        $this->company->categories()->attach($this->firstCategoryTest->id);
        $this->countCategories += 4;

        $this->actingAs($this->company);

    }
    /**
     * A basic feature test example.
     */
    public function test_quantity_categories(): void
    {
        $response = $this->get('/api/category');
        $categories = $response['total'];

        $response->assertStatus(200);
        $this->assertGreaterThanOrEqual($this->countCategories, $categories);
    }

    public function test_list_category_with_filter_order_by_type_asc(): void
    {
        
        $response = $this->get('/api/category?order_by=name&order_by_type=ASC');

        $response->assertStatus(200);
        
        $this->assertEquals($this->firstCategoryTest->name, $response['data'][0]['name']);
        $this->assertEquals($this->lastCategoryTest->name, $response['data'][$this->countCategories-1]['name']);
    }

    public function test_list_category_with_filter_order_by_type_desc(): void
    {
        
        $response = $this->get('/api/category?order_by=name&order_by_type=DESC');
        
        $this->assertEquals($this->lastCategoryTest->name, $response['data'][0]['name']);
        $response->assertStatus(200);
    }

    public function test_list_category_with_filter_search_by_with_out_search_by_type(): void
    {
        
        $this->get('/api/category?search_by=pizza')->assertStatus(302);

    }

    public function test_list_category_with_filter_search_by_type(): void
    {
        $email = 'empresa@gmail.com';

        $company = Company::where('email', $email)->first();
        if(!$company){
            $company = Company::factory()->create(['email' => $email]);
        }

        $this->actingAs($company);
        
        $response = $this->get('/api/category?search_by=pizza&search_type=name');

        $response->assertStatus(200);
    }
}
