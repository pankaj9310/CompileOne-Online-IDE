// shuffle algorithm example
#include <iostream>     // std::cout
#include <algorithm>    // std::shuffle
      // std::default_random_engine
#include <vector>
using namespace std;
int main () {
    int arr[]  = {1,2,3,4,5};
  vector<int> foo(5);


  shuffle (foo.begin(), foo.end(), 3);

  for(int i=0;i<foo.size();i++)
  cout<<foo[i]<<" ";
  return 0;
}