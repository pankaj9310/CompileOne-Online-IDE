#include <iostream>
using namespace std;

template<typename T>
class Vector3d {
public:
    Vector3d(T x, T y, T z) {
        this.x = x;
        this.y = y;
        this.z = z;
    }
private:
    int x, y, z;
};

int main() {
	cout << "Hello, World!";
	Vector3d* vec = new Vector3d<int>(2,2,2);
}
