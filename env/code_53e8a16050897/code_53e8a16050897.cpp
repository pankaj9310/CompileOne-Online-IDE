#include <iostream>
using namespace std;

class Robot
{
  private :
    string name;
    string surname;
  public:
    Robot(string name, string surname){
        this->name = name;
        this->surname = surname;
    }
    void displayInfo(){
        cout << this->name << this->surname << endl;
    }
 
};

int main() {
	
	
	cout << "Hello world from PASS" << endl;
	return 0;
}
