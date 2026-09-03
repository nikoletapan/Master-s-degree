
//////////////////////////////////////////////////////////////////////////////////////////////////////
// Zapo4nah po metoda ot u4ebnika na Dodunekov:                                                     //
// izvar6vame preobrazuvaniqta na 1-te nad glavniq i pod glavniq diagonal ednovremenno,             //
// taka ne se nalaga da izpolzvam vtora funkciq back, koqto da zanulqva 1-te nad glavniq diagonal,  //
// sled kato e zanulila 1-te pod glavniq diagonal                                                   //
// (ottuk - zaradi 2-to obhojdane nagore/naobratno mi idvaha vsi4ki gre6ki).                        //
// Algoritamat ne moje da razmestva stalbove, a samo redove                                         //
// (no razmqnata na stalbove ne e elementarna operaciq, taka 4e mislq 4e ne e - ).                  //
// Ponqkoga printira edna i sa6ta matrica 2 pati (dosega sam go zabelqzala samo za 2ta matr.).      //
//                                                                                                  //
// Primer:                                                                                          //
//                                                                                                  //
// |0 1 0 1|< swap  |1 1 0 1|+ + sum    |1 1 0 1|< sum     |1 0 0 0| sum   |1 0 0 0|                //
// |1 1 0 1|<       |0 1 0 1|| |        |0 1 0 1|+         |0 1 0 1|       |0 1 0 1| i se vijda, 4e // 
// |1 1 1 1|   <=>  |1 1 1 1|< |   <=>  |0 0 1 0|  +  <=>  |0 0 1 0|+  <=> |0 0 1 0|                //
// |1 0 1 0|        |1 0 1 0|  <        |0 1 1 1|  <       |0 0 1 0|<      |0 0 0 0|     rank = 3.  //
//////////////////////////////////////////////////////////////////////////////////////////////////////

import java.io.*;
import java.util.StringTokenizer;  // Tokenizer -> razbiva string na znaci

class OrderedMatrix {




   static void swap(byte[][] A, int i, int k, int j){    // razmenq redovete
      int m = A[0].length - 1;             // pre: A[i][q]==A[k][q]==0 for 1<=q<j
      byte temp;
      for(int q=j; q<=m; q++){
         temp = A[i][q];              // razmenq red i s red k
         A[i][q] = A[k][q];
         A[k][q] = temp;
      }
   }
   

   static void sum(byte [][] A, int i, int j){    // sumira 2 reda
	      int n = A.length - 1;       // 1 red pod na6iq (a ne pod na4alniq [0]
	      int m = A[0].length - 1;    // 1 stylb sled [0]
	      for(int p=1; p<=n; p++){        // cikal, obhojda6t redovete
	         if( p!=i && A[p][j]!= 0 ){    // ako ne sme v teku6tiq red i ima element sas stojnost != 0
	            for(int q=j+1; q<=m; q++){  // obhojdame stalbovete
	            	A[p][q] ^= A[p][j] * A[i][q]; // naj-vajniqt red :))))))
	            }
	            A[p][j] = 0;        
	         }
	      }
	   }

   static void printMatrix(PrintWriter out, byte[][] A){    // izvejdame matricata
     int n = A.length - 1;
     int m = A[0].length - 1;
      for(int i=1; i<=n; i++){
         for(int j=1; j<=m; j++) out.print(A[i][j] + "  ");
         out.println();
      }
      out.println();
      out.println();
   }

   public static void main(String[] args) throws IOException {   // 4ete in.txt, inicializira matricata, razmenq redovete i izvejda v out.txt
      int n, m, i, j, k;
      String line;
      StringTokenizer st;
      String inFile = "in.txt";
      String outFile = "out.txt";

      BufferedReader in = new BufferedReader(new FileReader(inFile));
      PrintWriter out = new PrintWriter(new FileWriter(outFile));

      line = in.readLine();                     // 4ete parviq red ot in.txt
      st = new StringTokenizer(line);
      n = Integer.parseInt(st.nextToken());     // parvite 2 4isla v in.txt sa n i m (br na redovete i kolonite, tip int)
      m = Integer.parseInt(st.nextToken());

      byte[][] A = new byte[n+1][m+1];           // ve4e A 6te e (n+1)x(m+1)zaradi 1 red

      for(i=1; i<=n; i++){                  // 4ete sledva6tite n-reda ot tip byte i inicializira redicata A
         line = in.readLine();
         st = new StringTokenizer(line);
         for(j=1; j<=m; j++){
            A[i][j] = Byte.parseByte(st.nextToken());
         }
      }

      in.close();       // zatvarqme

      printMatrix(out, A);             // izvejdame na4alniq rezultat

      i = 1;                  // po4va se :((
      j = 1;
      while( i<=n && j<=m ){

         k = i;                            
         while( k<=n && A[k][j]==0 ) k++;   //tarsim nenulev element v kolona j ili pod red i

         if( k<=n ){           // ako e nameren v red k

            if( k!=i ) { //  ako k ne e i, razmenqme red i s red k  -> polu4ava se vqrno, kato izkliu4im 4e 2-ta matrica se povtarq 2 pati!!
               swap(A, i, k, j);
               printMatrix(out, A);
            } 
               
            if( A[i][j]!= 0 ){           // ako A[i][j] ne e 0, sabirame 2 reda
                sum(A, i, j);
                 printMatrix(out, A);
               }
           // }
            i++;
         }
         j++;
      }
      out.println("rank = " + (i-1)); // Dopalnitelno izpisva ranga.
      out.close();          // zatvarqme out.txt
   }
   
}
