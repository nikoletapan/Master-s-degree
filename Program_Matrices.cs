using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;

namespace Matrices
{
    class Program
    {
        public static int dim;
        public static int[,] matrix;

        static void Main(string[] args)
        {
            readFile("matrix.txt");
            displayMatrix(matrix);
            Console.WriteLine();
            findProductOfPositiveUpperElements();
            Console.WriteLine();
            int row = -1;
            int min = findMinLowerElement(out row);
            displayMatrix(removeRow(row));
            Console.ReadLine();
        }

        static void readFile(String fileName)
        {
            StreamReader sr = new StreamReader(fileName);
            dim = Convert.ToInt32(sr.ReadLine());
            matrix = new int[dim, dim];
            String line = String.Empty;
            int i = 0, j = 0;
            while ((line = sr.ReadLine()) != null)
            {
                string[] numbers = line.Split(' ');
                j = 0;
                foreach (string number in numbers)
                {
                    int n = Convert.ToInt32(number);
                    matrix[i, j] = n;
                    j++;
                }
                i++;
            }
            sr.Close();
        }

        static int findProductOfPositiveUpperElements()
        {
            Console.WriteLine("Find the product of positive elements from the upper triangular matrix (no diag. included):");
            if (matrix != null)
            {
                int product = 1;
                for (int i = 0; i <= matrix.GetLength(0); i++)
                {
                    for (int j = i + 1; j < matrix.GetLength(1); j++)
                    {
                        if (matrix[i, j] > 0)
                        {
                            product *= matrix[i, j];
                        }
                        Console.Write(matrix[i, j] + " ");
                    }
                    Console.WriteLine();
                }
                Console.Write("Product = {0}", product);
                Console.WriteLine();
                return product;
            }
            else
            {
                Console.WriteLine("Uninitialized matrix!");
                return 0; ;
            }
        }

        static int findMinLowerElement(out int row)
        {
            Console.WriteLine("Find the minimum from the lower triangular matrix:");
            if (matrix != null)
            {
                int min = int.MaxValue;
                row = -1;
                for (int i = 1; i < matrix.GetLength(0); i++)
                {
                    for (int j = 0; j < i; j++)
                    {
                        if (matrix[i, j] < min)
                        {
                            min = matrix[i, j];
                            row = i;
                        }
                        Console.Write(matrix[i, j] + " ");
                    }
                    Console.WriteLine();
                }
                Console.WriteLine("Min value = {0} at row {1}", min, row);

                return min;
            }
            else
            {
                Console.WriteLine("Uninitialized matrix!");
                row = -1;
                return 0;
            }
        }

        static int[,] removeRow(int rowIndex)
        {
            if (matrix != null)
            {
                Console.WriteLine("Matrix after removing row #{0}:", rowIndex);
                int[,] newMatrix = new int[dim - 1, dim];
                bool found = false;

                for (int i = 0; i < matrix.GetLength(0); i++)
                {
                    for (int j = 0; j < matrix.GetLength(1); j++)
                    {
                        if (i != rowIndex)
                        {
                            if (found)
                            {
                                newMatrix[i - 1, j] = matrix[i, j];
                            }
                            else
                            {
                                newMatrix[i, j] = matrix[i, j];
                            }

                        }
                        else
                        {
                            found = true;
                        }
                    }
                }
                return newMatrix;
            }
            else
            {
                Console.WriteLine("Uninitialized matrix!");
                return null;
            }
        }

        static void displayMatrix(int[,] m)
        {
            if (m != null)
            {
                for (int i = 0; i < m.GetLength(0); i++)
                {
                    for (int j = 0; j < m.GetLength(1); j++)
                    {
                        Console.Write(m[i, j] + " ");
                    }
                    Console.WriteLine();
                }
            }
        }

    }
}
