<?php

namespace App\Http;

use App\Http\Controllers\Controller;
use App\Product;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Http\Request;
use App\Product\Factories\ProductFactory;

class ProductsController extends Controller
{
    public function create(
        Request $request,
        CompanyRepositoryInterface $companyRepository,
        ProductRepositoryInterface $productRepository,
        CategoriesRepositoryInterface $categoriesRepository,
        ProductFactory $productFactory
    ) {
        try {
            $companyId = (int)$request->get('company_id');
            $categoryId = (int)$request->get('category_id');

            $company = $companyRepository->findOrFail($companyId);
            $category = $categoriesRepository->findOrFail($categoryId);

            $product = $productFactory->make($request->all(), $company);

            $productRepository->store($product);

            $product->addCategory($category);

            $productRepository->store($product);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Product successfully created.'
        ]);
    }
}
